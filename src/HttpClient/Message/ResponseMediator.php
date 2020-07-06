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
use Bitbucket\JsonArray;
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

        if ($body === '') {
            return [];
        }

        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') !== 0) {
            throw new DecodingFailedException('The content type header was not application/json.');
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
            return array_filter(self::getContent($response), [self::class, 'paginationFilter'], ARRAY_FILTER_USE_KEY);
        } catch (DecodingFailedException $e) {
            return [];
        }
    }

    /**
     * @param string|int $key
     * @return bool
     */
    private static function paginationFilter($key)
    {
        return in_array($key, ['size', 'page', 'pagelen', 'next', 'previous'], true);
    }
}
