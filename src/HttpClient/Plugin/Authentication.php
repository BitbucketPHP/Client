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

use Bitbucket\Client;
use Bitbucket\Exception\RuntimeException;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * A plugin to add authentication to the request.
 *
 * @internal
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
final class Authentication implements Plugin
{
    /**
     * The authorization header.
     *
     * @var string
     */
    private $header;

    /**
     * Create a new authentication plugin instance.
     *
     * @param string      $method
     * @param string      $token
     * @param string|null $password
     *
     * @return void
     */
    public function __construct(string $method, string $token, string $password = null)
    {
        $this->header = self::buildAuthorizationHeader($method, $token, $password);
    }

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
        $request = $request->withHeader('Authorization', $this->header);

        return $next($request);
    }

    /**
     * Build the authentication header to be attached to the request.
     *
     * @param string      $method
     * @param string      $token
     * @param string|null $password
     *
     * @throws \Bitbucket\Exception\RuntimeException
     *
     * @return string
     */
    private static function buildAuthorizationHeader(string $method, string $token, string $password = null)
    {
        switch ($method) {
            case Client::AUTH_HTTP_PASSWORD:
                if ($password === null) {
                    throw new RuntimeException(sprintf('Authentication method "%s" requires a password to be set.', $method));
                }

                return sprintf('Basic %s', base64_encode(sprintf('%s:%s', $token, $password)));
            case Client::AUTH_OAUTH_TOKEN:
                return sprintf('Bearer %s', $token);
            case Client::AUTH_JWT:
                return sprintf('JWT %s', $token);
        }

        throw new RuntimeException(sprintf('Authentication method "%s" not implemented.', $method));
    }
}
