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
    public function test_projects_all()
    {
        $response = new ProjectsAllResponse();
        $client = $this->getClient($response);
        $projects = $client->teams('john_doe')->projects()->all();

        $this->assertCount(11, $projects);
    }

    public function test_projects_list()
    {
        $response = new ProjectsListResponse();
        $client = $this->getClient($response);
        $projects = $client->teams('john_doe')->projects()->list();

        $this->assertCount(9, $projects);
    }

    public function test_project_show()
    {
        $response = new ProjectsShowResponse();
        $client = $this->getClient($response);
        $project = $client->teams('john_doe')->projects()->show('Atlassian1');

        $this->assertCount(11, $project);
    }

    public function test_project_create()
    {
        $response = new ProjectCreateResponse();
        $client = $this->getClient($response);
        $project = $client->teams('john_doe')->projects()->create(
            'name',
            'key',
            'description',
            'links',
            true
        );

        $this->assertCount(11, $project);
    }

    public function test_project_update()
    {
        $response = new ProjectUpdateResponse();
        $client = $this->getClient($response);

        $project = $client->teams('john_doe')->projects()->update(
            'Atlassian1',
            'name-updated',
            'Atlassian1',
            'description-updated',
            '',
            true
        );

        $this->assertCount(11, $project);
    }

    public function test_project_remove()
    {
        $response = new ProjectRemoveResponse();
        $client = $this->getClient($response);

        $project = $client->teams('john_doe')->projects()->remove(
            'Atlassian1'
        );

        $this->assertCount(0, $project);
    }
}
