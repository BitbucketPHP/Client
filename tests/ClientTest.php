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
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Mock\Client as MockClient;
use PHPUnit\Framework\TestCase;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
final class ClientTest extends TestCase
{
    public function testCreateClient(): void
    {
        $client = new Client();

        self::assertInstanceOf(Client::class, $client);
        self::assertInstanceOf(HttpMethodsClientInterface::class, $client->getHttpClient());
    }

    public function testDefaultUserAgentHeaderMatchesClientVersion(): void
    {
        $httpClient = new MockClient();
        $client = new Client(new Builder($httpClient));

        $client->currentUser()->show();

        self::assertSame('bitbucket-php-api-client/5.1', $httpClient->getLastRequest()->getHeaderLine('User-Agent'));
    }
}
