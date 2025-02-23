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

namespace Bitbucket\Tests;

use Bitbucket\Client;
use Bitbucket\HttpClient\Builder;
use Http\Mock\Client as MockClient;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 * @author Giacomo Fabbian <info@giacomofabbian.it>
 */
final class MockedClient
{
    /**
     * @return \Bitbucket\Client
     */
    public static function create(ResponseInterface $response): \Bitbucket\Client
    {
        $client = new MockClient(self::createResponseFactory($response));

        return new Client(new Builder($client));
    }

    /**
     * @return \Psr\Http\Message\ResponseFactoryInterface
     */
    private static function createResponseFactory(ResponseInterface $response): \Psr\Http\Message\ResponseFactoryInterface
    {
        return new class($response) implements ResponseFactoryInterface {
            public function __construct(
                private readonly ResponseInterface $response,
            ) {
            }

            public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
            {
                return $this->response;
            }
        };
    }
}
