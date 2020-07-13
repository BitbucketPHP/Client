<?php

declare(strict_types=1);

/*
 * This file is part of Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
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
 * @author Graham Campbell <graham@alt-three.com>
 */
class Workspaces extends AbstractApi
{
    /**
     * The workspace.
     *
     * @var string
     */
    protected $workspace;

    /**
     * Create a new API instance.
     *
     * @param Client   $client
     * @param int|null $perPage
     * @param string   $workspace
     */
    public function __construct(Client $client, ?int $perPage, string $workspace)
    {
        parent::__construct($client, $perPage);
        $this->workspace = $workspace;
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(array $params = [])
    {
        $uri = $this->buildWorkspacesUri();

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function codeSearch(array $params = [])
    {
        $uri = $this->buildWorkspacesUri('search', 'code');

        return $this->get($uri, $params);
    }

    /**
     * @return \Bitbucket\Api\Workspaces\Hooks
     */
    public function hooks()
    {
        return new Hooks($this->getClient(), $this->getPerPage(), $this->workspace);
    }

    /**
     * @return \Bitbucket\Api\Workspaces\Members
     */
    public function members()
    {
        return new Members($this->getClient(), $this->getPerPage(), $this->workspace);
    }

    /**
     * @return \Bitbucket\Api\Workspaces\Permissions
     */
    public function permissions()
    {
        return new Permissions($this->getClient(), $this->getPerPage(), $this->workspace);
    }

    /**
     * @return \Bitbucket\Api\Workspaces\PipelinesConfig
     */
    public function pipelinesConfig()
    {
        return new PipelinesConfig($this->getClient(), $this->getPerPage(), $this->workspace);
    }

    /**
     * @return \Bitbucket\Api\Workspaces\Projects
     */
    public function projects()
    {
        return new Projects($this->getClient(), $this->getPerPage(), $this->workspace);
    }

    /**
     * Build the workspaces URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildWorkspacesUri(string ...$parts)
    {
        return UriBuilder::build('workspaces', $this->workspace, ...$parts);
    }
}
