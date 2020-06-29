<?php

namespace Bitbucket\Tests;

use Bitbucket\Client;
use Bitbucket\HttpClient\Builder;
use Bitbucket\Tests\responses\BaseResponse;
use Http\Mock\Client as MockClient;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @param BaseResponse $response
     *
     * @return Client
     */
    protected function getClient(BaseResponse $response)
    {
        $mock_client = new MockClient($response);
        $builder = new Builder($mock_client);

        return new Client($builder);
    }
}
