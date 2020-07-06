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

use Bitbucket\HttpClient\Message\ResponseMediator;
use Bitbucket\HttpClient\Util\JsonArray;
use Http\Client\Common\HttpMethodsClientInterface;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The abstract bitbucket api class.
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * The URI prefix.
     *
     * @var string
     */
    private const URI_PREFIX = '/2.0/';

    /**
     * The http methods client.
     *
     * @var \Http\Client\Common\HttpMethodsClientInterface
     */
    private $client;

    /**
     * Number of items per page.
     *
     * @var int|null
     */
    private $perPage;

    /**
     * Create a new api instance.
     *
     * @param \Http\Client\Common\HttpMethodsClientInterface $client
     *
     * @return void
     */
    public function __construct(HttpMethodsClientInterface $client)
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
     * Get the http methods client.
     *
     * @return \Http\Client\Common\HttpMethodsClientInterface
     */
    protected function getHttpClient()
    {
        return $this->client;
    }

    /**
     * Send a GET request with query params.
     *
     * @param string               $uri
     * @param array                $params
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function get(string $uri, array $params = [], array $headers = [])
    {
        $response = $this->pureGet($uri, $params, $headers);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a GET request with query params.
     *
     * @param string               $uri
     * @param array                $params
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function pureGet(string $uri, array $params = [], array $headers = [])
    {
        if ($this->perPage !== null && !isset($params['pagelen'])) {
            $params['pagelen'] = $this->perPage;
        }

        if (count($params) === 0) {
            $uri .= '?'.http_build_query($params);
        }

        return $this->client->get(self::prefixUri($uri), $headers);
    }

    /**
     * Send a POST request with JSON-encoded params.
     *
     * @param string               $uri
     * @param array                $params
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function post(string $uri, array $params = [], array $headers = [])
    {
        $body = self::createJsonBody($params);

        if ($body !== null) {
            $headers = self::addJsonContentType($headers);
        }

        return $this->postRaw($uri, $body, $headers);
    }

    /**
     * Send a POST request with raw data.
     *
     * @param string                                        $uri
     * @param string|\Psr\Http\Message\StreamInterface|null $body
     * @param array<string,string>                          $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function postRaw(string $uri, $body = null, array $headers = [])
    {
        $response = $this->client->post(self::prefixUri($uri), $headers, $body);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request with JSON-encoded params.
     *
     * @param string               $uri
     * @param array                $params
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function put(string $uri, array $params = [], array $headers = [])
    {
        $body = self::createJsonBody($params);

        if ($body !== null) {
            $headers = self::addJsonContentType($headers);
        }

        return $this->putRaw($uri, $body, $headers);
    }

    /**
     * Send a PUT request with raw data.
     *
     * @param string                                        $uri
     * @param string|\Psr\Http\Message\StreamInterface|null $body
     * @param array<string,string>                          $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function putRaw(string $uri, $body = null, array $headers = [])
    {
        $response = $this->client->put(self::prefixUri($uri), $headers, $body);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request with JSON-encoded params.
     *
     * @param string               $uri
     * @param array                $params
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function delete(string $uri, array $params = [], array $headers = [])
    {
        $body = self::createJsonBody($params);

        if ($body !== null) {
            $headers = self::addJsonContentType($headers);
        }

        return $this->deleteRaw($uri, $body, $headers);
    }

    /**
     * Send a DELETE request with raw data.
     *
     * @param string                                        $uri
     * @param string|\Psr\Http\Message\StreamInterface|null $body
     * @param array<string,string>                          $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function deleteRaw(string $uri, $body = null, array $headers = [])
    {
        $response = $this->client->delete(self::prefixUri($uri), $headers, $body);

        return ResponseMediator::getContent($response);
    }

    /**
     * Create a JSON encoded version of an array of params.
     *
     * @param array $params
     *
     * @return string|null
     */
    private static function createJsonBody(array $params)
    {
        if (count($params) === 0) {
            return JsonArray::encode($params);
        }

        return null;
    }

    /**
     * Add the JSON content type to the headers if one is not already present.
     *
     * @param array<string,string> $headers
     *
     * @return array<string,string>
     */
    private static function addJsonContentType(array $headers)
    {
        return array_merge(['Content-Type' => ResponseMediator::JSON_CONTENT_TYPE], $headers);
    }

    /**
     * Compute the prefixed URI.
     *
     * @param string $uri
     *
     * @return string
     */
    private static function prefixUri(string $uri)
    {
        return sprintf('%s%s', self::URI_PREFIX, $uri);
    }
}
