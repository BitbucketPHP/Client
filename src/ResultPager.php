<?php

declare(strict_types=1);

/*
 * This file is part of Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket;

use Bitbucket\Api\ApiInterface;
use Bitbucket\Exception\RuntimeException;
use Bitbucket\HttpClient\Message\ResponseMediator;

/**
 * This is the result pager class.
 *
 * @author Ramon de la Fuente <ramon@future500.nl>
 * @author Mitchel Verschoof <mitchel@future500.nl>
 * @author Graham Campbell <graham@alt-three.com>
 */
final class ResultPager implements ResultPagerInterface
{
    /**
     * The client to use for pagination.
     *
     * @var \Bitbucket\Client
     */
    private $client;

    /**
     * The pagination result from the API.
     *
     * @var array<string,string>
     */
    private $pagination;

    /**
     * Create a new result pager instance.
     *
     * @param \Bitbucket\Client $client
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->pagination = [];
    }

    /**
     * Fetch a single result from an api call.
     *
     * @param \Bitbucket\Api\ApiInterface $api
     * @param string                      $method
     * @param array                       $parameters
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetch(ApiInterface $api, string $method, array $parameters = [])
    {
        /** @var mixed */
        $result = $api->$method(...$parameters);

        if (!is_array($result)) {
            throw new RuntimeException('Pagination of endpoints that produce blobs is not supported.');
        }

        $this->postFetch();

        return $result;
    }

    /**
     * Fetch all results from an api call.
     *
     * @param \Bitbucket\Api\ApiInterface $api
     * @param string                      $method
     * @param array                       $parameters
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetchAll(ApiInterface $api, string $method, array $parameters = [])
    {
        $perPage = $api->getPerPage();

        $api->setPerPage(50);

        try {
            $result = self::getValues($this->fetch($api, $method, $parameters));

            while ($this->hasNext()) {
                $next = self::getValues($this->fetchNext());
                $result = array_merge($result, $next);
            }
        } finally {
            $api->setPerPage($perPage);
        }

        /** @var array */
        return $result;
    }

    /**
     * Check to determine the availability of a next page.
     *
     * @return bool
     */
    public function hasNext()
    {
        return isset($this->pagination['next']);
    }

    /**
     * Fetch the next page.
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetchNext()
    {
        return $this->get('next');
    }

    /**
     * Check to determine the availability of a previous page.
     *
     * @return bool
     */
    public function hasPrevious()
    {
        return isset($this->pagination['prev']);
    }

    /**
     * Fetch the previous page.
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetchPrevious()
    {
        return $this->get('prev');
    }

    /**
     * Refresh the pagination property.
     *
     * @return void
     */
    private function postFetch()
    {
        $response = $this->client->getLastResponse();

        if ($response === null) {
            $this->pagination = [];
        } else {
            $this->pagination = ResponseMediator::getPagination($response);
        }
    }

    /**
     * @param string $key
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    private function get(string $key)
    {
        $pagination = $this->pagination[$key] ?? null;

        if ($pagination === null) {
            return [];
        }

        $result = $this->client->getHttpClient()->get($pagination);

        $content = ResponseMediator::getContent($result);

        $this->postFetch();

        return $content;
    }

    /**
     * @param array $result
     *
     * @throws \Bitbucket\Exception\RuntimeException
     *
     * @return array
     */
    private static function getValues(array $result)
    {
        if (!isset($result['values']) || !is_array($result['values'])) {
            throw new RuntimeException('Pagination of endpoints that produce value lists is not supported.');
        }

        return $result['values'];
    }
}
