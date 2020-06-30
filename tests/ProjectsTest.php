<?php

namespace Bitbucket\Tests;

use Bitbucket\Tests\responses\ProjectCreateResponse;
use Bitbucket\Tests\responses\ProjectRemoveResponse;
use Bitbucket\Tests\responses\ProjectsAllResponse;
use Bitbucket\Tests\responses\ProjectsListResponse;
use Bitbucket\Tests\responses\ProjectsShowResponse;
use Bitbucket\Tests\responses\ProjectUpdateResponse;

class ProjectsTest extends TestCase
{
    public function test_projects_list()
    {
        $response = new ProjectsListResponse();
        $client = $this->getClient($response);
        $projects = $client->workspaces('my-workspace')->projects()->list();

        $this->assertCount(9, $projects['values']);
    }

    public function test_project_show()
    {
        $response = new ProjectsShowResponse();
        $client = $this->getClient($response);
        $project = $client->workspaces('my-workspace')->projects()->show('Atlassian1');

        $this->assertCount(11, $project);
    }

    public function test_project_create()
    {
        $response = new ProjectCreateResponse();
        $client = $this->getClient($response);

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

        $project = $client->workspaces('my-workspace')->projects()->create(
            $params
        );

        $this->assertCount(11, $project);
    }

    public function test_project_update()
    {
        $response = new ProjectUpdateResponse();
        $client = $this->getClient($response);

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

        $project = $client->workspaces('my-workspace')->projects()->update(
            'Atlassian1',
            $params
        );

        $this->assertCount(11, $project);
    }

    public function test_project_remove()
    {
        $response = new ProjectRemoveResponse();
        $client = $this->getClient($response);

        $project = $client->workspaces('my-workspace')->projects()->remove(
            'Atlassian1'
        );

        $this->assertCount(0, $project);
    }
}
