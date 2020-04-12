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
use Http\Client\Common\HttpMethodsClient;
use PHPUnit\Framework\TestCase;

/**
 * This is the client test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ClientTest extends TestCase
{
    public function testCreateClient()
    {
        $client = new Client();

        $this->assertInstanceOf(Client::class, $client);
        $this->assertInstanceOf(HttpMethodsClient::class, $client->getHttpClient());
    }

    public function testShowRepo()
    {
        $client = new Client();

        $response = $client
            ->repositories()
            ->users('atlassian')
            ->show('stash-example-plugin');

        $this->assertIsArray($response);
        $this->assertTrue(isset($response['uuid']));
        $this->assertSame('{7dd600e6-0d9c-4801-b967-cb4cc17359ff}', $response['uuid']);
    }
}
