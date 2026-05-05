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

namespace Bitbucket\Api;

use Bitbucket\Api\Workspaces\Hooks;
use Bitbucket\Api\Workspaces\Members;
use Bitbucket\Api\Workspaces\Permissions;
use Bitbucket\Api\Workspaces\PipelinesConfig;
use Bitbucket\Api\Workspaces\Projects;
use Bitbucket\Api\Workspaces\PullRequests as WorkspacesPullRequests;
use Bitbucket\Client;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The workspaces API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Workspaces extends AbstractApi
{
    protected readonly string $workspace;

    public function __construct(Client $client, string $workspace)
    {
        parent::__construct($client);
        $this->workspace = $workspace;
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(array $params = []): array
    {
        $uri = $this->buildWorkspacesUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated legacy code search
     */
    public function codeSearch(array $params = []): array
    {
        $uri = $this->buildWorkspacesUri('search', 'code');

        return $this->get($uri, $params);
    }

    public function hooks(): Hooks
    {
        return new Hooks($this->getClient(), $this->workspace);
    }

    public function members(): Members
    {
        return new Members($this->getClient(), $this->workspace);
    }

    public function permissions(): Permissions
    {
        return new Permissions($this->getClient(), $this->workspace);
    }

    public function pipelinesConfig(): PipelinesConfig
    {
        return new PipelinesConfig($this->getClient(), $this->workspace);
    }

    public function projects(): Projects
    {
        return new Projects($this->getClient(), $this->workspace);
    }

    public function pullRequests(): WorkspacesPullRequests
    {
        return new WorkspacesPullRequests($this->getClient(), $this->workspace);
    }

    /**
     * Build the workspaces URI from the given parts.
     */
    protected function buildWorkspacesUri(string ...$parts): string
    {
        return UriBuilder::build('workspaces', $this->workspace, ...$parts);
    }
}
