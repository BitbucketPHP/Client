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
     *
     * @return array
     */
    public function show(array $params = []): array
    {
        $uri = $this->buildWorkspacesUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function codeSearch(array $params = []): array
    {
        $uri = $this->buildWorkspacesUri('search', 'code');

        return $this->get($uri, $params);
    }

    /**
     * @return \Bitbucket\Api\Workspaces\Hooks
     */
    public function hooks(): \Bitbucket\Api\Workspaces\Hooks
    {
        return new Hooks($this->getClient(), $this->workspace);
    }

    /**
     * @return \Bitbucket\Api\Workspaces\Members
     */
    public function members(): \Bitbucket\Api\Workspaces\Members
    {
        return new Members($this->getClient(), $this->workspace);
    }

    /**
     * @return \Bitbucket\Api\Workspaces\Permissions
     */
    public function permissions(): \Bitbucket\Api\Workspaces\Permissions
    {
        return new Permissions($this->getClient(), $this->workspace);
    }

    /**
     * @return \Bitbucket\Api\Workspaces\PipelinesConfig
     */
    public function pipelinesConfig(): \Bitbucket\Api\Workspaces\PipelinesConfig
    {
        return new PipelinesConfig($this->getClient(), $this->workspace);
    }

    /**
     * @return \Bitbucket\Api\Workspaces\Projects
     */
    public function projects(): \Bitbucket\Api\Workspaces\Projects
    {
        return new Projects($this->getClient(), $this->workspace);
    }

    /**
     * Build the workspaces URI from the given parts.
     *
     * @return string
     */
    protected function buildWorkspacesUri(string ...$parts): string
    {
        return UriBuilder::build('workspaces', $this->workspace, ...$parts);
    }
}
