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

namespace Bitbucket\HttpClient\Plugin;

use Gitlab\Exception\ApiLimitExceededException;
use Gitlab\Exception\BadRequestException;
use Gitlab\Exception\ClientErrorException;
use Gitlab\Exception\DecodingException;
use Gitlab\Exception\ServerErrorException;
use Gitlab\Exception\ValidationException;
use Gitlab\HttpClient\Message\ResponseMediator;
use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * A plugin to throw bitbucket exceptions.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Fabien Bourigault <bourigaultfabien@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
class ExceptionThrower implements Plugin
{
    /**
     * Handle the request and return the response coming from the next callable.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @param callable                           $next
     * @param callable                           $first
     *
     * @throws \Gitlab\Exception\RuntimeException
     *
     * @return \Http\Promise\Promise
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        return $next($request)->then(function (ResponseInterface $response) {
            if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 600) {
                $message = self::getMessage($response);

                if ($response->getStatusCode() === 400) {
                    throw new BadRequestException($message, $response->getStatusCode());
                }

                if ($response->getStatusCode() === 422) {
                    throw new ValidationException($message, $response->getStatusCode());
                }

                if ($response->getStatusCode() === 429) {
                    throw new ApiLimitExceededException($message, $response->getStatusCode());
                }

                if ($response->getStatusCode() < 500) {
                    throw new ClientErrorException($message, $response->getStatusCode());
                }

                throw new ServerErrorException($message, $response->getStatusCode());
            }

            return $response;
        });
    }

    /**
     * Get the error message from the response if present.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return string|null
     */
    private static function getMessage(ResponseInterface $response)
    {
        try {
            return ResponseMediator::getContent($response)['error']['message'] ?? null;
        } catch (DecodingException $e) {
            // return nothing
        }
    }
}
