<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Tests;

use Bitbucket\Client;
use Bitbucket\HttpClient\Builder;
use Bitbucket\HttpClient\Util\JsonArray;
use Bitbucket\ResultPager;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Http\Mock\Client as MockClient;
use PHPUnit\Framework\TestCase;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class ResultPagerTest extends TestCase
{
    public function testFetchAllPreservesPaginationFields(): void
    {
        $httpClient = new MockClient();

        $httpClient->addResponse(self::jsonResponse([
            'pagelen' => 1,
            'next' => 'https://api.bitbucket.org/2.0/repositories/my-workspace/my-repo/refs/tags?page=2',
            'values' => [
                ['name' => 'v1.0.0'],
            ],
        ]));

        $httpClient->addResponse(self::jsonResponse([
            'pagelen' => 1,
            'values' => [
                ['name' => 'v1.0.1'],
            ],
        ]));

        $client = new Client(new Builder($httpClient));
        $pager = new ResultPager($client, 1);

        $tags = $pager->fetchAll(
            $client->repositories()->workspaces('my-workspace')->refs('my-repo')->tags(),
            'list',
            [['fields' => 'values.name']]
        );

        self::assertSame([['name' => 'v1.0.0'], ['name' => 'v1.0.1']], $tags);

        $requests = $httpClient->getRequests();
        $query = [];
        \parse_str($requests[0]->getUri()->getQuery(), $query);

        self::assertSame('values.name,size,page,pagelen,next,previous', $query['fields']);
    }

    public function testDirectCallsDoNotPreservePaginationFields(): void
    {
        $httpClient = new MockClient();

        $httpClient->addResponse(self::jsonResponse(['values' => []]));

        $client = new Client(new Builder($httpClient));

        $client->repositories()
            ->workspaces('my-workspace')
            ->refs('my-repo')
            ->tags()
            ->list(['fields' => 'values.name']);

        $query = [];
        \parse_str($httpClient->getLastRequest()->getUri()->getQuery(), $query);

        self::assertSame('values.name', $query['fields']);
    }

    public function testHasPreviousUsesPreviousPaginationField(): void
    {
        $httpClient = new MockClient();

        $httpClient->addResponse(self::jsonResponse([
            'pagelen' => 1,
            'previous' => 'https://api.bitbucket.org/2.0/repositories/my-workspace/my-repo/refs/tags?page=1',
            'values' => [
                ['name' => 'v1.0.1'],
            ],
        ]));

        $client = new Client(new Builder($httpClient));
        $pager = new ResultPager($client, 1);

        $pager->fetch(
            $client->repositories()->workspaces('my-workspace')->refs('my-repo')->tags(),
            'list'
        );

        self::assertTrue($pager->hasPrevious());
    }

    public function testFetchPreviousUsesPreviousPaginationField(): void
    {
        $previous = 'https://api.bitbucket.org/2.0/repositories/my-workspace/my-repo/refs/tags?page=1&opaque=true';
        $httpClient = new MockClient();

        $httpClient->addResponse(self::jsonResponse([
            'pagelen' => 1,
            'previous' => $previous,
            'values' => [
                ['name' => 'v1.0.1'],
            ],
        ]));

        $httpClient->addResponse(self::jsonResponse([
            'pagelen' => 1,
            'values' => [
                ['name' => 'v1.0.0'],
            ],
        ]));

        $client = new Client(new Builder($httpClient));
        $pager = new ResultPager($client, 1);

        $pager->fetch(
            $client->repositories()->workspaces('my-workspace')->refs('my-repo')->tags(),
            'list'
        );

        self::assertSame([['name' => 'v1.0.0']], $pager->fetchPrevious());

        $requests = $httpClient->getRequests();

        self::assertSame($previous, (string) $requests[1]->getUri());
    }

    public function testFetchPreviousReturnsEmptyArrayWithoutPreviousLink(): void
    {
        $httpClient = new MockClient();

        $httpClient->addResponse(self::jsonResponse([
            'pagelen' => 1,
            'values' => [
                ['name' => 'v1.0.0'],
            ],
        ]));

        $client = new Client(new Builder($httpClient));
        $pager = new ResultPager($client, 1);

        $pager->fetch(
            $client->repositories()->workspaces('my-workspace')->refs('my-repo')->tags(),
            'list'
        );

        self::assertFalse($pager->hasPrevious());
        self::assertSame([], $pager->fetchPrevious());
    }

    private static function jsonResponse(array $data): Response
    {
        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            Utils::streamFor(JsonArray::encode($data))
        );
    }
}
