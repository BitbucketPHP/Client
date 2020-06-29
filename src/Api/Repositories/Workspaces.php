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

namespace Bitbucket\Api\Repositories;

use Bitbucket\Api\Repositories\Workspaces\BranchingModel;
use Bitbucket\Api\Repositories\Workspaces\BranchRestrictions;
use Bitbucket\Api\Repositories\Workspaces\Commit;
use Bitbucket\Api\Repositories\Workspaces\Commits;
use Bitbucket\Api\Repositories\Workspaces\Components;
use Bitbucket\Api\Repositories\Workspaces\DefaultReviewers;
use Bitbucket\Api\Repositories\Workspaces\DeployKeys;
use Bitbucket\Api\Repositories\Workspaces\Deployments;
use Bitbucket\Api\Repositories\Workspaces\Diffs;
use Bitbucket\Api\Repositories\Workspaces\DiffStat;
use Bitbucket\Api\Repositories\Workspaces\Downloads;
use Bitbucket\Api\Repositories\Workspaces\Environments;
use Bitbucket\Api\Repositories\Workspaces\FileHistory;
use Bitbucket\Api\Repositories\Workspaces\Forks;
use Bitbucket\Api\Repositories\Workspaces\Hooks;
use Bitbucket\Api\Repositories\Workspaces\Issues;
use Bitbucket\Api\Repositories\Workspaces\Milestones;
use Bitbucket\Api\Repositories\Workspaces\Patches;
use Bitbucket\Api\Repositories\Workspaces\Pipelines;
use Bitbucket\Api\Repositories\Workspaces\PipelinesConfig;
use Bitbucket\Api\Repositories\Workspaces\Properties;
use Bitbucket\Api\Repositories\Workspaces\PullRequests;
use Bitbucket\Api\Repositories\Workspaces\Refs;
use Bitbucket\Api\Repositories\Workspaces\Src;
use Bitbucket\Api\Repositories\Workspaces\Versions;
use Bitbucket\Api\Repositories\Workspaces\Watchers;

/**
 * The workspaces api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Workspaces extends AbstractRepositoriesApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = [])
    {
        $path = $this->buildWorkspacesPath();

        return $this->get($path, $params);
    }

    /**
     * @param string $repo
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $repo, array $params = [])
    {
        $path = $this->buildWorkspacesPath($repo);

        return $this->get($path, $params);
    }

    /**
     * @param string $repo
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(string $repo, array $params = [])
    {
        $path = $this->buildWorkspacesPath($repo);

        return $this->post($path, $params);
    }

    /**
     * @param string $repo
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $repo, array $params = [])
    {
        $path = $this->buildWorkspacesPath($repo);

        return $this->put($path, $params);
    }

    /**
     * @param string $repo
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $repo, array $params = [])
    {
        $path = $this->buildWorkspacesPath($repo);

        return $this->delete($path, $params);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\BranchingModel
     */
    public function branchingModel(string $repo)
    {
        return new BranchingModel($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\BranchRestrictions
     */
    public function branchRestrictions(string $repo)
    {
        return new BranchRestrictions($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Commit
     */
    public function commit(string $repo)
    {
        return new Commit($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Commits
     */
    public function commits(string $repo)
    {
        return new Commits($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Components
     */
    public function components(string $repo)
    {
        return new Components($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\DefaultReviewers
     */
    public function defaultReviewers(string $repo)
    {
        return new DefaultReviewers($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\DeployKeys
     */
    public function deployKeys(string $repo)
    {
        return new DeployKeys($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Deployments
     */
    public function deployments(string $repo)
    {
        return new Deployments($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Diffs
     */
    public function diffs(string $repo)
    {
        return new Diffs($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\DiffStat
     */
    public function diffStat(string $repo)
    {
        return new DiffStat($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Downloads
     */
    public function downloads(string $repo)
    {
        return new Downloads($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Environments
     */
    public function environments(string $repo)
    {
        return new Environments($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\FileHistory
     */
    public function fileHistory(string $repo)
    {
        return new FileHistory($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Forks
     */
    public function forks(string $repo)
    {
        return new Forks($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Hooks
     */
    public function hooks(string $repo)
    {
        return new Hooks($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Issues
     */
    public function issues(string $repo)
    {
        return new Issues($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Milestones
     */
    public function milestones(string $repo)
    {
        return new Milestones($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Patches
     */
    public function patches(string $repo)
    {
        return new Patches($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Pipelines
     */
    public function pipelines(string $repo)
    {
        return new Pipelines($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PipelinesConfig
     */
    public function pipelinesConfig(string $repo)
    {
        return new PipelinesConfig($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Properties
     */
    public function properties(string $repo)
    {
        return new Properties($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests
     */
    public function pullRequests(string $repo)
    {
        return new PullRequests($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Refs
     */
    public function refs(string $repo)
    {
        return new Refs($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Src
     */
    public function src(string $repo)
    {
        return new Src($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Versions
     */
    public function versions(string $repo)
    {
        return new Versions($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Watchers
     */
    public function watchers(string $repo)
    {
        return new Watchers($this->getHttpClient(), $this->workspace, $repo);
    }

    /**
     * Build the workspaces path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildWorkspacesPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, ...$parts);
    }
}
