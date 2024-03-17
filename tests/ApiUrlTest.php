<?php

declare(strict_types=1);

namespace Bitbucket\Tests;

use Bitbucket\Client;
use Bitbucket\HttpClient\Builder;
use Http\Mock\Client as MockClient;
use PHPUnit\Framework\TestCase;

/**
 * Tests API URLs constructed in Src and Downloads API classes.
 */
class ApiUrlTest extends TestCase
{
    protected MockClient $httpClient;
    protected Client $client;

    public function setUp(): void
    {
        $this->httpClient = new MockClient();
        $this->client = new Client(new Builder($this->httpClient));
    }

    /**
     * @covers \Bitbucket\Api\Repositories\Workspaces\Src::show
     * @covers \Bitbucket\Api\Repositories\Workspaces\Src::buildSrcUri
     *
     * @dataProvider dataProvider
     */
    public function testWorkspaceSrcShowUri(string $fileName): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->src('my-project')
            ->show('main', $fileName);

        $this->assertSame(
            "https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/src/main/$fileName?format=meta",
            (string) $this->httpClient->getLastRequest()->getUri()
        );
    }

    /**
     * @covers \Bitbucket\Api\Repositories\Workspaces\Src::download
     * @covers \Bitbucket\Api\Repositories\Workspaces\Src::buildSrcUri
     *
     * @dataProvider dataProvider
     */
    public function testWorkspaceSrcDownloadUri(string $fileName): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->src('my-project')
            ->download('main', $fileName);

        $this->assertSame(
            "https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/src/main/$fileName",
            (string) $this->httpClient->getLastRequest()->getUri()
        );
    }

    /**
     * @covers \Bitbucket\Api\Repositories\Workspaces\Downloads::download
     * @covers \Bitbucket\Api\Repositories\Workspaces\Downloads::buildDownloadsUri
     *
     * @dataProvider dataProvider
     */
    public function testWorkspaceDownloadUri(string $fileName): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->downloads('my-project')
            ->download($fileName);

        $this->assertSame(
            "https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/downloads/$fileName",
            (string) $this->httpClient->getLastRequest()->getUri()
        );
    }

    /**
     * @covers \Bitbucket\Api\Repositories\Workspaces\Downloads::remove
     * @covers \Bitbucket\Api\Repositories\Workspaces\Downloads::buildDownloadsUri
     *
     * @dataProvider dataProvider
     */
    public function testWorkspaceRemoveUri(string $fileName): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->downloads('my-project')
            ->remove($fileName);

        $this->assertSame(
            "https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/downloads/$fileName",
            (string) $this->httpClient->getLastRequest()->getUri()
        );
    }

    public static function dataProvider(): array
    {
        return [
            'File in root' => ['README.md'],
            'File in subdirectory' => ['docs/contributing/CODE_OF_CONDUCT.md'],
        ];
    }
}
