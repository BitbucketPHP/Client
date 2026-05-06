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
use Psr\Http\Message\StreamInterface;

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
     * The pagination fields.
     *
     * @var string[]
     */
    private const PAGINATION_FIELDS = ['size', 'page', 'pagelen', 'next', 'previous'];

    private readonly Client $client;

    private ?int $perPage;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->perPage = null;
    }

    /**
     * Get the bitbucket client instance.
     */
    protected function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Send a GET request with query params and return the raw response.
     *
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
     */
    protected function getAsResponse(string $uri, array $params = [], array $headers = []): ResponseInterface
    {
        if (null !== $this->perPage) {
            if (!isset($params['pagelen'])) {
                $params['pagelen'] = $this->perPage;
            }

            if (isset($params['fields']) && \is_string($params['fields']) && '' !== \trim($params['fields'])) {
                $params['fields'] = self::withPaginationFields($params['fields']);
            }
        }

        return $this->client->getHttpClient()->get(self::prepareUri($uri, $params), $headers);
    }

    /**
     * Send a GET request with query params.
     *
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
     */
    protected function get(string $uri, array $params = [], array $headers = []): array
    {
        $response = $this->getAsResponse($uri, $params, $headers);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a POST request with JSON-encoded params.
     *
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
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
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
     */
    protected function postRaw(string $uri, string|StreamInterface|null $body = null, array $headers = []): array
    {
        $response = $this->client->getHttpClient()->post(self::prepareUri($uri), $headers, $body ?? '');

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request with JSON-encoded params.
     *
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
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
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
     */
    protected function putRaw(string $uri, string|StreamInterface|null $body = null, array $headers = []): array
    {
        $response = $this->client->getHttpClient()->put(self::prepareUri($uri), $headers, $body ?? '');

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request with JSON-encoded params.
     *
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
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
     * @param array<string,string> $headers
     *
     * @throws \Http\Client\Exception
     */
    protected function deleteRaw(string $uri, string|StreamInterface|null $body = null, array $headers = []): array
    {
        $response = $this->client->getHttpClient()->delete(self::prepareUri($uri), $headers, $body ?? '');

        return ResponseMediator::getContent($response);
    }

    /**
     * Prepare the request URI.
     */
    private static function prepareUri(string $uri, array $query = []): string
    {
        return \sprintf('%s%s%s', self::URI_PREFIX, $uri, QueryStringBuilder::build($query));
    }

    /**
     * Add the pagination fields to the given fields parameter.
     */
    private static function withPaginationFields(string $fields): string
    {
        $parts = \array_values(\array_filter(
            \array_map('trim', \explode(',', $fields)),
            static function (string $field): bool {
                return '' !== $field;
            }
        ));

        if ([] === $parts) {
            return $fields;
        }

        $prefix = self::usesAdditiveFields($parts) ? '+' : '';

        foreach (self::PAGINATION_FIELDS as $field) {
            if (!self::containsIncludedField($parts, $field)) {
                $parts[] = $prefix.$field;
            }
        }

        return \implode(',', $parts);
    }

    /**
     * @param string[] $fields
     */
    private static function usesAdditiveFields(array $fields): bool
    {
        if (\in_array('-*', $fields, true)) {
            return true;
        }

        foreach ($fields as $field) {
            if (!\str_starts_with($field, '+') && !\str_starts_with($field, '-')) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string[] $fields
     */
    private static function containsIncludedField(array $fields, string $field): bool
    {
        return \in_array($field, $fields, true) || \in_array("+{$field}", $fields, true);
    }

    /**
     * Prepare the request JSON body.
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
