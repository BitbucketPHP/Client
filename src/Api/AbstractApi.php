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

use Bitbucket\Exception\InvalidArgumentException;
use Bitbucket\HttpClient\Message\ResponseMediator;
use Http\Client\Common\HttpMethodsClient;

/**
 * The abstract bitbucket api class.
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * The http methods client.
     *
     * @var \Http\Client\Common\HttpMethodsClient
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
     * @param \Http\Client\Common\HttpMethodsClient $client
     *
     * @return void
     */
    public function __construct(HttpMethodsClient $client)
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
     * @return \Http\Client\Common\HttpMethodsClient
     */
    protected function getHttpClient()
    {
        return $this->client;
    }

    /**
     * Send a GET request with query params.
     *
     * @param string $path
     * @param array  $params
     * @param array  $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function get(string $path, array $params = [], array $headers = [])
    {
        $response = $this->pureGet($path, $params, $headers);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a GET request with query params.
     *
     * @param string $path
     * @param array  $params
     * @param array  $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function pureGet(string $path, array $params = [], array $headers = [])
    {
        if ($this->perPage !== null && !isset($params['pagelen'])) {
            $params['pagelen'] = $this->perPage;
        }

        if ($params) {
            $path .= '?'.http_build_query($params);
        }

        return $this->client->get(self::computePath($path), $headers);
    }

    /**
     * Send a POST request with JSON-encoded params.
     *
     * @param string $path
     * @param array  $params
     * @param array  $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function post(string $path, array $params = [], array $headers = [])
    {
        $body = self::createJsonBody($params);

        if ($body) {
            $headers = self::addJsonContentType($headers);
        }

        return $this->postRaw($path, $body, $headers);
    }

    /**
     * Send a POST request with raw data.
     *
     * @param string                                        $path
     * @param string|\Psr\Http\Message\StreamInterface|null $body
     * @param array                                         $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function postRaw(string $path, $body = null, array $headers = [])
    {
        $response = $this->client->post(self::computePath($path), $headers, $body);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request with JSON-encoded params.
     *
     * @param string $path
     * @param array  $params
     * @param array  $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function put(string $path, array $params = [], array $headers = [])
    {
        $body = self::createJsonBody($params);

        if ($body) {
            $headers = self::addJsonContentType($headers);
        }

        return $this->putRaw($path, $body, $headers);
    }

    /**
     * Send a PUT request with raw data.
     *
     * @param string                                        $path
     * @param string|\Psr\Http\Message\StreamInterface|null $body
     * @param array                                         $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function putRaw(string $path, $body = null, array $headers = [])
    {
        $response = $this->client->put(self::computePath($path), $headers, $body);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request with JSON-encoded params.
     *
     * @param string $path
     * @param array  $params
     * @param array  $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function delete(string $path, array $params = [], array $headers = [])
    {
        $body = self::createJsonBody($params);

        if ($body) {
            $headers = self::addJsonContentType($headers);
        }

        return $this->deleteRaw($path, $body, $headers);
    }

    /**
     * Send a DELETE request with raw data.
     *
     * @param string                                        $path
     * @param string|\Psr\Http\Message\StreamInterface|null $body
     * @param array                                         $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    protected function deleteRaw(string $path, $body = null, array $headers = [])
    {
        $response = $this->client->delete(self::computePath($path), $headers, $body);

        return ResponseMediator::getContent($response);
    }

    /**
     * Build a URL path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected static function buildPath(string ...$parts)
    {
        $parts = array_map(function (string $part) {
            if (!$part) {
                throw new InvalidArgumentException('Missing required parameter.');
            }

            return self::urlEncode($part);
        }, $parts);

        return implode('/', $parts);
    }

    /**
     * Compute the prefixed API path.
     *
     * @param string $path
     *
     * @return string
     */
    private static function computePath(string $path)
    {
        return sprintf('/2.0/%s', $path);
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
        if ($params) {
            return json_encode($params);
        }
    }

    /**
     * Add the JSON content type to the headers if one is not already present.
     *
     * @param array $headers
     *
     * @return array
     */
    private static function addJsonContentType(array $headers)
    {
        return array_merge(['Content-Type' => 'application/json'], $headers);
    }

    /**
     * Encode the given string for a URL.
     *
     * @param string $str
     *
     * @return string
     */
    private static function urlEncode(string $str)
    {
        $str = rawurlencode($str);

        return str_replace('.', '%2E', $str);
    }
}
