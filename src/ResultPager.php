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
use Bitbucket\Exception\InvalidArgumentException;
use Bitbucket\HttpClient\Message\ResponseMediator;

/**
 * This is the result pager class.
 *
 * @author Ramon de la Fuente <ramon@future500.nl>
 * @author Mitchel Verschoof <mitchel@future500.nl>
 * @author Graham Campbell <graham@alt-three.com>
 */
class ResultPager implements ResultPagerInterface
{
    /**
     * The client to use for pagination.
     *
     * @var \Bitbucket\Client
     */
    protected $client;

    /**
     * The pagination result from the API.
     *
     * @var array|null
     */
    protected $pagination;

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
     * Get the pagination result of the last request.
     *
     * @return array|null
     */
    public function getPagination()
    {
        return $this->pagination;
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
    public function fetch(ApiInterface $api, $method, array $parameters = [])
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
    public function fetchAll(ApiInterface $api, $method, array $parameters = [])
    {
        // get the perPage from the api
        $perPage = $api->getPerPage();

        // set parameters per_page to max to minimize number of requests
        $api->setPerPage(100);

        try {
            $result = $this->fetch($api, $method, $parameters)['values'];

            while ($this->hasNext()) {
                $next = $this->fetchNext();
                $result = array_merge($result, $next['values']);
            }
        } finally {
            // restore the perPage
            $api->setPerPage($perPage);
        }

        return $result;
    }

    /**
     * Method that performs the actual work to refresh the pagination property.
     *
     * @return void
     */
    public function postFetch()
    {
        if ($response = $this->client->getLastResponse()) {
            $this->pagination = ResponseMediator::getPagination($response);
        } else {
            $this->pagination = null;
        }
    }

    /**
     * Check to determine the availability of a next page.
     *
     * @return bool
     */
    public function hasNext()
    {
        return $this->has('next');
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
        return $this->has('prev');
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
     * @param string $key
     *
     * @return bool
     */
    protected function has(string $key)
    {
        return isset($this->pagination[$key]);
    }

    /**
     * @param string $key
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function get(string $key)
    {
        if (!$this->has($key)) {
            throw new InvalidArgumentException('No such link exists.');
        }

        $result = $this->client->getHttpClient()->get($this->pagination[$key]);
        $this->postFetch();

        return ResponseMediator::getContent($result);
    }
}
