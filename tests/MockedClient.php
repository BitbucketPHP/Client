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

namespace Bitbucket\Tests;

use Bitbucket\Client;
use Bitbucket\HttpClient\Builder;
use Http\Message\ResponseFactory;
use Http\Mock\Client as MockClient;
use Psr\Http\Message\ResponseInterface;

/**
 * This is the mocked client class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author Giacomo Fabbian <info@giacomofabbian.it>
 */
final class MockedClient
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Bitbucket\Client
     */
    public static function create(ResponseInterface $response)
    {
        $client = new MockClient(self::createResponseFactory($response));

        return new Client(new Builder($client));
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Http\Message\ResponseFactory
     */
    private static function createResponseFactory(ResponseInterface $response)
    {
        return new class($response) implements ResponseFactory {
            private $response;

            public function __construct(ResponseInterface $response)
            {
                $this->response = $response;
            }

            public function createResponse(
                $statusCode = 200,
                $reasonPhrase = null,
                array $headers = [],
                $body = null,
                $protocolVersion = '1.1'
            ) {
                return $this->response;
            }
        };
    }
}
