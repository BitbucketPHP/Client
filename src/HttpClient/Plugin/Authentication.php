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
use Psr\Http\Message\RequestInterface;

/**
 * A plugin to add authentication to the request.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
class Authentication implements Plugin
{
    /**
     * The authorization header.
     *
     * @param string
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
        $this->header = static::buildAuthorizationHeader($method, $token, $password);
    }

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
    protected static function buildAuthorizationHeader(string $method, string $token, string $password = null)
    {
        switch ($method) {
            case Client::AUTH_HTTP_PASSWORD:
                return sprintf('Basic %s', base64_encode($token.':'.$password));
            case Client::AUTH_OAUTH_TOKEN:
                return sprintf('Bearer %s', $token);
        }

        throw new RuntimeException(sprintf('Authentication method "%s" not implemented.', $method));
    }
}
