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

use Bitbucket\Tests\Response\WorkspacesShowResponse;
use PHPUnit\Framework\TestCase;

/**
 * This is the workspaces test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author Giacomo Fabbian <info@giacomofabbian.it>
 */
final class WorkspacesTest extends TestCase
{
    public function testWorkspaceShow()
    {
        $client = MockedClient::create(
            WorkspacesShowResponse::create()
        );

        $response = $client->workspaces('my-workspace')->show();

        $this->assertIsArray($response);
        $this->assertCount(7, $response);
    }
}
