<?php

namespace Bitbucket\Tests;

use Bitbucket\Tests\responses\WorkspacesAllResponse;
use Bitbucket\Tests\responses\WorkspacesListResponse;
use Bitbucket\Tests\responses\WorkspacesShowResponse;

class WorkspacesTest extends TestCase
{
    public function test_workspaces_list()
    {
        $response = new WorkspacesListResponse();
        $client = $this->getClient($response);
        $workspaces = $client->workspaces('my-workspace')->list();

        $this->assertCount(4, $workspaces);
    }

    public function test_workspace_show()
    {
        $response = new WorkspacesShowResponse();
        $client = $this->getClient($response);
        $workspace = $client->workspaces('my-workspace')->show();

        $this->assertCount(7, $workspace);
    }
}
