<?php

namespace Bitbucket\Tests;

use Bitbucket\Api\AbstractApi;
use Bitbucket\Client;
use Bitbucket\HttpClient\Builder;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\File;
use Http\Mock\Client as MockClient;
use Psr\Http\Message\ResponseInterface;

class WorkspacesTest extends TestCase
{
    public function test_workspaces_list()
    {
        $path = $this->packagePath('/tests/stubs/workspaces-list-success.json');

        $mock_client = new MockClient;

        $response = $this->createMock('Bitbucket\Tests\responses\WorkspacesListResponse');

        $mock_client->setDefaultResponse($response);

        $request = $this->createMock('Psr\Http\Message\RequestInterface');

        $response = $mock_client->sendRequest($request);



        dd($response->getStatusCode());

        /*$builder = new Builder($mock_client);

        $client = new Client($builder);*/
    }
}
