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

namespace Bitbucket\HttpClient\Plugin;

use Bitbucket\Client;
use Bitbucket\Exception\RuntimeException;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * A plugin to add authentication to the request.
 *
 * @internal
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
final class Authentication implements Plugin
{
    private readonly string $header;
    private UriInterface $url;

    public function __construct(string $method, #[\SensitiveParameter] string $token, #[\SensitiveParameter] ?string $password, UriInterface $url)
    {
        $this->header = self::buildAuthorizationHeader($method, $token, $password);
        $this->url = $url;
    }

    public function withUrl(UriInterface $url): self
    {
        $plugin = clone $this;
        $plugin->url = $url;

        return $plugin;
    }

    /**
     * Handle the request and return the response coming from the next callable.
     *
     * @param callable(RequestInterface): Promise<ResponseInterface> $next
     * @param callable(RequestInterface): Promise<ResponseInterface> $first
     *
     * @return \Http\Promise\Promise<ResponseInterface>
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        if (self::isSameOrigin($request->getUri(), $this->url)) {
            $request = $request->withHeader('Authorization', $this->header);
        } elseif ($request->getHeaderLine('Authorization') === $this->header) {
            // a redirected request already carries it
            $request = $request->withoutHeader('Authorization');
        }

        return $next($request);
    }

    private static function isSameOrigin(UriInterface $a, UriInterface $b): bool
    {
        return 0 === \strcasecmp($a->getScheme(), $b->getScheme())
            && 0 === \strcasecmp($a->getHost(), $b->getHost())
            && self::getPort($a) === self::getPort($b);
    }

    private static function getPort(UriInterface $uri): ?int
    {
        return $uri->getPort() ?? ['http' => 80, 'https' => 443][\strtolower($uri->getScheme())] ?? null;
    }

    /**
     * Build the authentication header to be attached to the request.
     *
     * @throws \Bitbucket\Exception\RuntimeException
     */
    private static function buildAuthorizationHeader(string $method, #[\SensitiveParameter] string $token, #[\SensitiveParameter] ?string $password = null): string
    {
        switch ($method) {
            case Client::AUTH_HTTP_PASSWORD:
                if (null === $password) {
                    throw new RuntimeException(\sprintf('Authentication method "%s" requires a password to be set.', $method));
                }

                return \sprintf('Basic %s', \base64_encode(\sprintf('%s:%s', $token, $password)));
            case Client::AUTH_OAUTH_TOKEN:
                return \sprintf('Bearer %s', $token);
            case Client::AUTH_JWT:
                return \sprintf('JWT %s', $token);
        }

        throw new RuntimeException(\sprintf('Authentication method "%s" not implemented.', $method));
    }
}
