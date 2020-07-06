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
     * @var array|null
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
        $result = $api->$method(...$parameters);

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
            $result = $this->fetch($api, $method, $parameters)['values'];

            while ($this->hasNext()) {
                $next = $this->fetchNext();
                $result = array_merge($result, $next['values']);
            }
        } finally {
            $api->setPerPage($perPage);
        }

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
            $this->pagination = null;
        } else {
            $this->pagination = ResponseMediator::getPagination($response);
        }
    }

    /**
     * @param string $key
     *
     * @throws \Http\Client\Exception
     *
     * @return array<string,mixed>
     */
    private function get(string $key)
    {
        $pagination = isset($this->pagination[$key]) ? $this->pagination[$key] : null;

        if ($pagination === null) {
            return [];
        }

        $result = $this->client->getHttpClient()->get($pagination);

        $this->postFetch();

        /** @var array<string,mixed> */
        return ResponseMediator::getContent($result);
    }
}
