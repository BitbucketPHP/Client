<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api;

use Bitbucket\Client;
use Bitbucket\HttpClient\Message\ResponseMediator;
use Bitbucket\HttpClient\Util\JsonArray;
use Bitbucket\HttpClient\Util\QueryStringBuilder;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Joseph Bielawski <stloyd@gmail.com>
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
abstract class AbstractApi
{
    /**
     * The URI prefix.
     *
     * @var string
     */
    private const URI_PREFIX = '/2.0/';

    /**
     * The client instance.
     *
     * @var Client
     */
    private $client;

    /**
     * The per page parameter.
     *
     * @var int|null
     */
    private $perPage;

    /**
     * Create a new API instance.
     *
     * @param Client $client
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get the bitbucket client instance.
     *
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Send a GET request with query params and return the raw response.
     *
     * @param string               $uri
     * @param array                $params
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function getAsResponse(string $uri, array $params = [], array $headers = []): ResponseInterface
    {
        if (null !== $this->perPage && !isset($params['pagelen'])) {
            $params['pagelen'] = $this->perPage;
        }

        return $this->client->getHttpClient()->get(self::prepareUri($uri, $params), $headers);
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
    protected function get(string $uri, array $params = [], array $headers = []): array
    {
        $response = $this->getAsResponse($uri, $params, $headers);

        return ResponseMediator::getContent($response);
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
    protected function post(string $uri, array $params = [], array $headers = []): array
    {
        $body = self::prepareJsonBody($params);

        if (null !== $body) {
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
    protected function postRaw(string $uri, $body = null, array $headers = []): array
    {
        $response = $this->client->getHttpClient()->post(self::prepareUri($uri), $headers, $body ?? '');

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
    protected function put(string $uri, array $params = [], array $headers = []): array
    {
        $body = self::prepareJsonBody($params);

        if (null !== $body) {
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
    protected function putRaw(string $uri, $body = null, array $headers = []): array
    {
        $response = $this->client->getHttpClient()->put(self::prepareUri($uri), $headers, $body ?? '');

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
    protected function delete(string $uri, array $params = [], array $headers = []): array
    {
        $body = self::prepareJsonBody($params);

        if (null !== $body) {
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
    protected function deleteRaw(string $uri, $body = null, array $headers = []): array
    {
        $response = $this->client->getHttpClient()->delete(self::prepareUri($uri), $headers, $body ?? '');

        return ResponseMediator::getContent($response);
    }

    /**
     * Prepare the request URI.
     *
     * @param string $uri
     * @param array  $query
     *
     * @return string
     */
    private static function prepareUri(string $uri, array $query = []): string
    {
        return \sprintf('%s%s%s', self::URI_PREFIX, $uri, QueryStringBuilder::build($query));
    }

    /**
     * Prepare the request JSON body.
     *
     * @param array $params
     *
     * @return string|null
     */
    private static function prepareJsonBody(array $params): ?string
    {
        if (0 === \count($params)) {
            return null;
        }

        return JsonArray::encode($params);
    }

    /**
     * Add the JSON content type to the headers if one is not already present.
     *
     * @param array<string,string> $headers
     *
     * @return array<string,string>
     */
    private static function addJsonContentType(array $headers): array
    {
        return \array_merge([ResponseMediator::CONTENT_TYPE_HEADER => ResponseMediator::JSON_CONTENT_TYPE], $headers);
    }
}
