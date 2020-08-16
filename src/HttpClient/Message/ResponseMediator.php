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

namespace Bitbucket\HttpClient\Message;

use Bitbucket\Exception\RuntimeException;
use Bitbucket\HttpClient\Util\JsonArray;
use Psr\Http\Message\ResponseInterface;

/**
 * This is the response mediator class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
final class ResponseMediator
{
    /**
     * The JSON content type identifier.
     *
     * @var string
     */
    public const JSON_CONTENT_TYPE = 'application/json';

    /**
     * Get the decoded response content.
     *
     * If the there is no response body, we will always return the empty array.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @throws \Bitbucket\Exception\RuntimeException
     *
     * @return array
     */
    public static function getContent(ResponseInterface $response)
    {
        if (204 === $response->getStatusCode()) {
            return [];
        }

        $body = (string) $response->getBody();

        if ('' === $body) {
            return [];
        }

        if (0 !== \strpos($response->getHeaderLine('Content-Type'), self::JSON_CONTENT_TYPE)) {
            throw new RuntimeException(\sprintf('The content type was not %s.', self::JSON_CONTENT_TYPE));
        }

        return JsonArray::decode($body);
    }

    /**
     * Get the pagination data from the response.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array<string,string>
     */
    public static function getPagination(ResponseInterface $response)
    {
        try {
            /** @var array<string,string> */
            return \array_filter(self::getContent($response), [self::class, 'paginationFilter'], \ARRAY_FILTER_USE_KEY);
        } catch (RuntimeException $e) {
            return [];
        }
    }

    /**
     * @param string|int $key
     *
     * @return bool
     */
    private static function paginationFilter($key)
    {
        return \in_array($key, ['size', 'page', 'pagelen', 'next', 'previous'], true);
    }

    /**
     * Get the error message from the response if present.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return string|null
     */
    public static function getErrorMessage(ResponseInterface $response)
    {
        try {
            /** @var scalar|array */
            $error = self::getContent($response)['error'] ?? null;
        } catch (RuntimeException $e) {
            return null;
        }

        return \is_array($error) ? self::getMessageFromError($error) : null;
    }

    /**
     * Get the error message from the error array if present.
     *
     * @param array $error
     *
     * @return string|null
     */
    private static function getMessageFromError(array $error)
    {
        /** @var scalar|array */
        $message = $error['message'] ?? '';

        if (!\is_string($message)) {
            return null;
        }

        $detail = self::getDetailAsString($error);

        if ('' !== $message) {
            return '' !== $detail ? \sprintf('%s: %s', $message, $detail) : $message;
        }

        if ('' !== $detail) {
            return $detail;
        }

        return null;
    }

    /**
     * Present the detail portion of the error array.
     *
     * @param array $error
     *
     * @return string
     */
    private static function getDetailAsString(array $error)
    {
        /** @var string|array $detail */
        $detail = $error['detail'] ?? '';

        if ('' === $detail || [] === $detail) {
            return '';
        }

        return (string) \strtok(\is_string($detail) ? $detail : JsonArray::encode($detail), "\n");
    }
}
