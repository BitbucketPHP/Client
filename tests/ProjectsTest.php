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

use Bitbucket\Tests\Response\ProjectsCreateResponse;
use Bitbucket\Tests\Response\ProjectsListResponse;
use Bitbucket\Tests\Response\ProjectsRemoveResponse;
use Bitbucket\Tests\Response\ProjectsShowResponse;
use Bitbucket\Tests\Response\ProjectsUpdateResponse;
use PHPUnit\Framework\TestCase;

/**
 * This is the projects test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author Giacomo Fabbian <info@giacomofabbian.it>
 */
final class ProjectsTest extends TestCase
{
    public function testProjectList()
    {
        $client = MockedClient::create(
            ProjectsListResponse::create()
        );

        $response = $client
            ->workspaces('my-workspace')
            ->projects()
            ->list();

        self::assertIsArray($response);
        self::assertCount(9, $response['values']);
    }

    public function testProjectShow()
    {
        $client = MockedClient::create(
            ProjectsShowResponse::create()
        );

        $response = $client
            ->workspaces('my-workspace')
            ->projects()
            ->show('Atlassian1');

        self::assertIsArray($response);
        self::assertCount(11, $response);
    }

    public function testProjectCreate()
    {
        $client = MockedClient::create(
            ProjectsCreateResponse::create()
        );

        $params = [
            'name'        => 'name',
            'key'         => 'key',
            'description' => 'description',
            'links'       => (object) [
                'avatar' => (object) [
                    'href' => '',
                ],
            ],
            'is_private' => true,
        ];

        $response = $client
            ->workspaces('my-workspace')
            ->projects()
            ->create($params);

        self::assertIsArray($response);
        self::assertCount(11, $response);
    }

    public function testProjectUpdate()
    {
        $client = MockedClient::create(
            ProjectsUpdateResponse::create()
        );

        $params = [
            'name'        => 'name-updated',
            'key'         => 'Atlassian1',
            'description' => 'description-updated',
            'links'       => (object) [
                'avatar' => (object) [
                    'href' => '',
                ],
            ],
            'is_private' => true,
        ];

        $response = $client
            ->workspaces('my-workspace')
            ->projects()
            ->update('Atlassian1', $params);

        self::assertIsArray($response);
        self::assertCount(11, $response);
    }

    public function testProjectRemove()
    {
        $client = MockedClient::create(
            ProjectsRemoveResponse::create()
        );

        $response = $client
            ->workspaces('my-workspace')
            ->projects()
            ->remove('Atlassian1');

        self::assertIsArray($response);
        self::assertCount(0, $response);
    }
}
