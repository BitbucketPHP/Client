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

use Bitbucket\Exception\DecodingFailedException;
use Psr\Http\Message\ResponseInterface;

/**
 * This is the response mediator class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
final class ResponseMediator
{
    /**
     * Get the decoded response content.
     *
     * If the there is no response body, we will always return the empty array.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @throws \Bitbucket\Exception\DecodingFailedException
     *
     * @return array
     */
    public static function getContent(ResponseInterface $response)
    {
        if ($response->getStatusCode() === 204) {
            return [];
        }

        $body = (string) $response->getBody();

        if (!$body) {
            return [];
        }

        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') !== 0) {
            throw new DecodingFailedException('The content type header was not application/json.');
        }

        return self::jsonDecode($body);
    }

    /**
     * Decode the given JSON string to an array.
     *
     * @param string $body
     *
     * @throws \Bitbucket\Exception\DecodingFailedException
     *
     * @return array
     */
    private static function jsonDecode(string $body)
    {
        $content = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $msg = json_last_error_msg();

            throw new DecodingFailedException(
                'Failed to decode the json response body.'.($msg ? " {$msg}." : '')
            );
        }

        if (!is_array($content)) {
            throw new DecodingFailedException(
                'Failed to decode the json response body. Expected to decode to an array.'
            );
        }

        return $content;
    }

    /**
     * Get the pagination data from the response.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    public static function getPagination(ResponseInterface $response)
    {
        try {
            return array_filter(static::getContent($response), function ($key) {
                return in_array($key, ['size', 'page', 'pagelen', 'next', 'previous'], true);
            }, ARRAY_FILTER_USE_KEY);
        } catch (DecodingFailedException $e) {
            return [];
        }
    }
}
