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
use Bitbucket\Exception\RuntimeException;
use Bitbucket\Exception\ValidationFailedException;
use Bitbucket\HttpClient\Message\ResponseMediator;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * A plugin to throw bitbucket exceptions.
 *
 * @internal
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Fabien Bourigault <bourigaultfabien@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
final class BitbucketExceptionThrower implements Plugin
{
    /**
     * Handle the request and return the response coming from the next callable.
     *
     * @param \Psr\Http\Message\RequestInterface                     $request
     * @param callable(RequestInterface): Promise<ResponseInterface> $next
     * @param callable(RequestInterface): Promise<ResponseInterface> $first
     *
     * @return \Http\Promise\Promise<ResponseInterface>
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response): ResponseInterface {
            $status = $response->getStatusCode();

            if ($status >= 400 && $status < 600) {
                self::handleError($status, ResponseMediator::getErrorMessage($response) ?? $response->getReasonPhrase());
            }

            return $response;
        });
    }

    /**
     * Handle an error response.
     *
     * @param int    $status
     * @param string $message
     *
     * @throws \Bitbucket\Exception\ErrorException
     * @throws \Bitbucket\Exception\RuntimeException
     *
     * @return void
     */
    private static function handleError(int $status, string $message)
    {
        if ($status === 400 || $status === 422) {
            throw new ValidationFailedException($message, $status);
        }

        if ($status === 429) {
            throw new ApiLimitExceededException($message, $status);
        }

        throw new RuntimeException($message, $status);
    }
}
