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
use GuzzleHttp\Psr7\Response;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Mock\Client as MockClient;
use PHPUnit\Framework\TestCase;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
final class ClientTest extends TestCase
{
    public function testCreateClient(): void
    {
        $client = new Client();

        self::assertInstanceOf(Client::class, $client);
        self::assertInstanceOf(HttpMethodsClientInterface::class, $client->getHttpClient());
    }

    public function testAuthenticationIsSentToTheBaseUrl(): void
    {
        $httpClient = new MockClient();

        $client = new Client(new Builder($httpClient));
        $client->authenticate(Client::AUTH_OAUTH_TOKEN, 'my-token');
        $client->getHttpClient()->get('/2.0/user');
        $client->getHttpClient()->get('https://API.bitbucket.org:443/2.0/repositories?page=2');

        $requests = $httpClient->getRequests();

        self::assertSame('Bearer my-token', $requests[0]->getHeaderLine('Authorization'));
        self::assertSame('Bearer my-token', $requests[1]->getHeaderLine('Authorization'));
    }

    public function testAuthenticationIsNotSentToOtherOrigins(): void
    {
        $httpClient = new MockClient();

        $client = new Client(new Builder($httpClient));
        $client->authenticate(Client::AUTH_HTTP_PASSWORD, 'my-username', 'my-password');
        $client->getHttpClient()->get('https://bitbucket.org/my-workspace/my-repo');
        $client->getHttpClient()->get('http://api.bitbucket.org/2.0/user');
        $client->getHttpClient()->get('https://api.bitbucket.org:8443/2.0/user');
        $client->getHttpClient()->get('https://api.bitbucket.org.example.com/2.0/user');

        $requests = $httpClient->getRequests();

        self::assertCount(4, $requests);

        foreach ($requests as $request) {
            self::assertFalse($request->hasHeader('Authorization'), (string) $request->getUri());
        }
    }

    public function testAuthenticationIsRemovedFromRequestsToOtherOrigins(): void
    {
        $httpClient = new MockClient();

        $client = new Client(new Builder($httpClient));
        $client->authenticate(Client::AUTH_OAUTH_TOKEN, 'my-token');
        $client->getHttpClient()->get('https://bitbucket.example.com/2.0/user', ['Authorization' => 'Bearer my-token']);
        $client->getHttpClient()->get('https://bitbucket.example.com/2.0/user', ['Authorization' => 'Bearer other-token']);

        $requests = $httpClient->getRequests();

        self::assertFalse($requests[0]->hasHeader('Authorization'));
        self::assertSame('Bearer other-token', $requests[1]->getHeaderLine('Authorization'));
    }

    public function testAuthenticationFollowsTheBaseUrl(): void
    {
        $httpClient = new MockClient();

        $client = new Client(new Builder($httpClient));
        $client->authenticate(Client::AUTH_OAUTH_TOKEN, 'my-token');
        $client->setUrl('https://bitbucket.example.com');
        $client->getHttpClient()->get('/2.0/user');
        $client->getHttpClient()->get('https://api.bitbucket.org/2.0/user');

        $requests = $httpClient->getRequests();

        self::assertSame('bitbucket.example.com', $requests[0]->getUri()->getHost());
        self::assertSame('Bearer my-token', $requests[0]->getHeaderLine('Authorization'));
        self::assertFalse($requests[1]->hasHeader('Authorization'));
    }

    public function testAuthenticationIsSentToTheBaseUrlOnRedirect(): void
    {
        $httpClient = new MockClient();

        $httpClient->addResponse(new Response(302, ['Location' => 'https://api.bitbucket.org/2.0/repositories/my-workspace/my-repo/diff/abc..def']));

        $client = new Client(new Builder($httpClient));
        $client->authenticate(Client::AUTH_OAUTH_TOKEN, 'my-token');
        $client->repositories()->workspaces('my-workspace')->pullRequests('my-repo')->diff('1')->download();

        $requests = $httpClient->getRequests();

        self::assertSame('/2.0/repositories/my-workspace/my-repo/diff/abc..def', $requests[1]->getUri()->getPath());
        self::assertSame('Bearer my-token', $requests[1]->getHeaderLine('Authorization'));
    }

    public function testAuthenticationIsNotSentToOtherOriginsOnRedirect(): void
    {
        $httpClient = new MockClient();

        $httpClient->addResponse(new Response(302, ['Location' => 'https://bbuseruploads.s3.amazonaws.com/my-file.zip?Signature=abc']));

        $client = new Client(new Builder($httpClient));
        $client->authenticate(Client::AUTH_OAUTH_TOKEN, 'my-token');
        $client->repositories()->workspaces('my-workspace')->downloads('my-repo')->download('my-file.zip');

        $requests = $httpClient->getRequests();

        self::assertSame('Bearer my-token', $requests[0]->getHeaderLine('Authorization'));
        self::assertSame('bbuseruploads.s3.amazonaws.com', $requests[1]->getUri()->getHost());
        self::assertFalse($requests[1]->hasHeader('Authorization'));
    }
}
