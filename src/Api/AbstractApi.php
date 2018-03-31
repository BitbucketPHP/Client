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

namespace Bitbucket\Api;

use Bitbucket\Client;
use Bitbucket\HttpClient\Message\ResponseMediator;

/**
 * The abstract bitbucket api class.
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 * @author Graham Campbell <graham@alt-thre.com>
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * The api client.
     *
     * @var \Bitbucket\Client
     */
    protected $client;

    /**
     * Number of items per page.
     *
     * @var int|null
     */
    protected $perPage;

    /**
     * Create a new api instance.
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
     * Get the number of values to fetch per page.
     *
     * @return int|null
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * Set the number of values to fetch per page.
     *
     * @param int|null $perPage
     *
     * @return void
     */
    public function setPerPage(int $perPage = null)
    {
        $this->perPage = $perPage;
    }

    /**
     * Send a GET request with query params.
     *
     * @param string $path
     * @param array  $params
     * @param array  $headers
     *
     * @return array
     */
    protected function get(string $path, array $params = [], array $headers = [])
    {
        if ($this->perPage !== null && !isset($params['pagelen'])) {
            $params['pagelen'] = $this->perPage;
        }

        if ($params) {
            $path .= '?'.http_build_query($params);
        }

        $response = $this->client->getHttpClient()->get($path, $headers);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a HEAD request with query params.
     *
     * @param string $path
     * @param array  $params
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function head(string $path, array $params = [], array $headers = [])
    {
        if ($params) {
            $path .= '?'.http_build_query($params);
        }

        return $this->client->getHttpClient()->head($path, $headers);
    }

    /**
     * Send a POST request with JSON-encoded params.
     *
     * @param string $path
     * @param array  $params
     * @param array  $headers
     *
     * @return array
     */
    protected function post(string $path, array $params = [], array $headers = [])
    {
        return $this->postRaw($path, static::createJsonBody($params), $headers);
    }

    /**
     * Send a POST request with raw data.
     *
     * @param string $path
     * @param string $body
     * @param array  $headers
     *
     * @return array
     */
    protected function postRaw(string $path, string $body, array $headers = [])
    {
        $response = $this->client->getHttpClient()->post($path, $headers, $body);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PATCH request with JSON-encoded params.
     *
     * @param string $path
     * @param array  $params
     * @param array  $headers
     *
     * @return array
     */
    protected function patch(string $path, array $params = [], array $headers = [])
    {
        $response = $this->client->getHttpClient()->patch($path, $headers, static::createJsonBody($params));

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request with JSON-encoded params.
     *
     * @param string $path
     * @param array  $params
     * @param array  $headers
     *
     * @return array
     */
    protected function put(string $path, array $params = [], array $headers = [])
    {
        $response = $this->client->getHttpClient()->put($path, $headers, static::createJsonBody($params));

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request with JSON-encoded params.
     *
     * @param string $path
     * @param array  $params
     * @param array  $headers
     *
     * @return array
     */
    protected function delete(string $path, array $params = [], array $headers = [])
    {
        $response = $this->client->getHttpClient()->delete($path, $headers, static::createJsonBody($params));

        return ResponseMediator::getContent($response);
    }

    /**
     * Create a JSON encoded version of an array of params.
     *
     * @param array $params
     *
     * @return string|null
     */
    protected static function createJsonBody(array $params)
    {
        if ($params) {
            return json_encode($params);
        }
    }
}
