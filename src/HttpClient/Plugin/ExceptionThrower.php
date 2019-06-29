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

use Bitbucket\Exception\ApiLimitExceededException;
use Bitbucket\Exception\BadRequestException;
use Bitbucket\Exception\ClientErrorException;
use Bitbucket\Exception\DecodingFailedException;
use Bitbucket\Exception\ServerErrorException;
use Bitbucket\Exception\ValidationFailedException;
use Bitbucket\HttpClient\Message\ResponseMediator;
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
     * @return \Http\Promise\Promise
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        return $next($request)->then(function (ResponseInterface $response) {
            $status = $response->getStatusCode();

            if ($status >= 400 && $status < 600) {
                self::handleError($status, self::getMessage($response) ?: $response->getReasonPhrase());
            }

            return $response;
        });
    }

    /**
     * Handle an error response.
     *
     * @param int         $status
     * @param string|null $message
     *
     * @throws \Bitbucket\Exception\RuntimeException
     *
     * @return void
     */
    private static function handleError(int $status, string $message = null)
    {
        if ($status === 400) {
            throw new BadRequestException($message, $status);
        }

        if ($status === 422) {
            throw new ValidationFailedException($message, $status);
        }

        if ($status === 429) {
            throw new ApiLimitExceededException($message, $status);
        }

        if ($status < 500) {
            throw new ClientErrorException($message, $status);
        }

        throw new ServerErrorException($message, $status);
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
            if ($error = ResponseMediator::getContent($response)['error'] ?? null) {
                if ($message = $error['message'] ?? null) {
                    if ($detail = $error['detail'] ?? null) {
                        return sprintf('%s: %s', $message, strtok(is_string($detail) ? $detail : json_encode($detail), "\n"));
                    } else {
                        return $message;
                    }
                }
            }
        } catch (DecodingFailedException $e) {
            // return nothing
        }
    }
}
