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
 * Add authentication to the request.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
class Authentication implements Plugin
{
    /**
     * The authentication method.
     *
     * @param string
     */
    private $method;

    /**
     * The oauth token or username.
     *
     * @var string
     */
    private $token;

    /**
     * The password if required.
     *
     * @var string|null
     */
    private $password;

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
        $this->method = $method;
        $this->token = $token;
        $this->password = $password;
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
        switch ($this->method) {
            case Client::AUTH_HTTP_PASSWORD:
                $request = $request->withHeader(
                    'Authorization',
                    sprintf('Basic %s', base64_encode($this->token.':'.$this->password))
                );
                break;

            case Client::AUTH_OAUTH_TOKEN:
                $request = $request->withHeader(
                    'Authorization',
                    sprintf('Bearer %s', $this->token)
                );
                break;

            default:
                throw new RuntimeException(sprintf('%s not yet implemented.', $this->method));
        }

        return $next($request);
    }
}
