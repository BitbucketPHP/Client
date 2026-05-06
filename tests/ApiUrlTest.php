<?php

declare(strict_types=1);

namespace Bitbucket\Tests;

use Bitbucket\Client;
use Bitbucket\HttpClient\Builder;
use Http\Mock\Client as MockClient;
use PHPUnit\Framework\Attributes\DataProvider;
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

    #[DataProvider('dataProvider')]
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

    public function testWorkspaceSrcShowRootDirectoryUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->src('my-project')
            ->show('main', '/');

        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/src/main/',
            (string) $this->httpClient->getLastRequest()->getUri()
        );
    }

    public function testWorkspaceSrcShowEmptyRootDirectoryUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->src('my-project')
            ->show('main', '');

        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/src/main/',
            (string) $this->httpClient->getLastRequest()->getUri()
        );
    }

    public function testWorkspaceSrcShowRootDirectoryUriWithMaxDepth(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->src('my-project')
            ->show('main', '/', ['max_depth' => 10]);

        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/src/main/?max_depth=10',
            (string) $this->httpClient->getLastRequest()->getUri()
        );
    }

    public function testWorkspaceSrcShowDirectoryUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->src('my-project')
            ->show('main', 'docs/');

        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/src/main/docs/',
            (string) $this->httpClient->getLastRequest()->getUri()
        );
    }

    public function testWorkspaceSrcShowDirectoryUriWithSlashInBranchName(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->src('my-project')
            ->show('feature/demo', '/');

        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/src/feature%2Fdemo/',
            (string) $this->httpClient->getLastRequest()->getUri()
        );
    }

    #[DataProvider('dataProvider')]
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

    #[DataProvider('dataProvider')]
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

    #[DataProvider('dataProvider')]
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

    public function testWorkspacePermissionsConfigGroupsListUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->permissionsConfig('my-project')
            ->groups()
            ->list(['pagelen' => 50]);

        $request = $this->httpClient->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/permissions-config/groups?pagelen=50',
            (string) $request->getUri()
        );
    }

    public function testWorkspacePermissionsConfigGroupsShowUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->permissionsConfig('my-project')
            ->groups()
            ->show('developers');

        $request = $this->httpClient->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/permissions-config/groups/developers',
            (string) $request->getUri()
        );
    }

    public function testWorkspacePermissionsConfigGroupsUpdateUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->permissionsConfig('my-project')
            ->groups()
            ->update('developers', ['permission' => 'write']);

        $request = $this->httpClient->getLastRequest();

        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/permissions-config/groups/developers',
            (string) $request->getUri()
        );
        $this->assertSame('{"permission":"write"}', (string) $request->getBody());
    }

    public function testWorkspacePermissionsConfigGroupsRemoveUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->permissionsConfig('my-project')
            ->groups()
            ->remove('developers');

        $request = $this->httpClient->getLastRequest();

        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/permissions-config/groups/developers',
            (string) $request->getUri()
        );
    }

    public function testWorkspacePermissionsConfigUsersListUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->permissionsConfig('my-project')
            ->users()
            ->list(['pagelen' => 50]);

        $request = $this->httpClient->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/permissions-config/users?pagelen=50',
            (string) $request->getUri()
        );
    }

    public function testWorkspacePermissionsConfigUsersShowUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->permissionsConfig('my-project')
            ->users()
            ->show('{abc-123}');

        $request = $this->httpClient->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/permissions-config/users/%7Babc-123%7D',
            (string) $request->getUri()
        );
    }

    public function testWorkspacePermissionsConfigUsersUpdateUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->permissionsConfig('my-project')
            ->users()
            ->update('{abc-123}', ['permission' => 'admin']);

        $request = $this->httpClient->getLastRequest();

        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/permissions-config/users/%7Babc-123%7D',
            (string) $request->getUri()
        );
        $this->assertSame('{"permission":"admin"}', (string) $request->getBody());
    }

    public function testWorkspacePermissionsConfigUsersRemoveUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->permissionsConfig('my-project')
            ->users()
            ->remove('{abc-123}');

        $request = $this->httpClient->getLastRequest();

        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/permissions-config/users/%7Babc-123%7D',
            (string) $request->getUri()
        );
    }

    public function testWorkspaceEffectiveBranchingModelShowUri(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->effectiveBranchingModel('my-project')
            ->show();

        $request = $this->httpClient->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/effective-branching-model',
            (string) $request->getUri()
        );
    }

    public function testWorkspaceEffectiveBranchingModelShowUriWithFields(): void
    {
        $this->client->repositories()
            ->workspaces('my-workspace')
            ->effectiveBranchingModel('my-project')
            ->show(['fields' => 'development,production,branch_types']);

        $request = $this->httpClient->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(
            'https://api.bitbucket.org/2.0/repositories/my-workspace/my-project/effective-branching-model?fields=development%2Cproduction%2Cbranch_types',
            (string) $request->getUri()
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
