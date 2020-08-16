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
use Bitbucket\Exception\RuntimeException;
use PHPUnit\Framework\TestCase;

/**
 * @author Graham Campbell <graham@alt-three.com>
 */
final class IntegrationTest extends TestCase
{
    public function testShowRepo(): void
    {
        $client = new Client();

        $response = $client
            ->repositories()
            ->workspaces('atlassian')
            ->show('stash-example-plugin');

        self::assertIsArray($response);
        self::assertTrue(isset($response['uuid']));
        self::assertSame('{7dd600e6-0d9c-4801-b967-cb4cc17359ff}', $response['uuid']);
    }

    public function testRepoNotFound(): void
    {
        $client = new Client();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Repository atlassian/qwertyuiop not found');

        $client
            ->repositories()
            ->workspaces('atlassian')
            ->show('qwertyuiop');
    }
}
