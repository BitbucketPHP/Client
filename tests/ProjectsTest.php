<?php

namespace Bitbucket\Tests;

use Bitbucket\Tests\responses\WorkspacesListResponse;

class ProjectsTest extends TestCase
{
    public function test_workspaces_all()
    {
        $response = new WorkspacesListResponse();
        $client = $this->getClient($response);
        $projects = $client->teams('test')->projects()->all();

        $this->assertCount(5, $projects);
    }

    public function test_workspaces_list()
    {
        //
    }

    public function test_workspaces_show()
    {
        //
    }

    public function test_workspaces_create()
    {
        //
    }

    public function test_workspaces_update()
    {
        //
    }

    public function test_workspaces_remove()
    {
        //
    }
}
