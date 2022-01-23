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
use Bitbucket\Api\Repositories\Workspaces\MergeBases;
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
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The workspaces API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
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
        $uri = $this->buildWorkspacesUri();

        return $this->get($uri, $params);
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
        $uri = $this->buildWorkspacesUri($repo);

        return $this->get($uri, $params);
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
        $uri = $this->buildWorkspacesUri($repo);

        return $this->post($uri, $params);
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
        $uri = $this->buildWorkspacesUri($repo);

        return $this->put($uri, $params);
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
        $uri = $this->buildWorkspacesUri($repo);

        return $this->delete($uri, $params);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\BranchingModel
     */
    public function branchingModel(string $repo)
    {
        return new BranchingModel($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\BranchRestrictions
     */
    public function branchRestrictions(string $repo)
    {
        return new BranchRestrictions($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Commit
     */
    public function commit(string $repo)
    {
        return new Commit($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Commits
     */
    public function commits(string $repo)
    {
        return new Commits($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Components
     */
    public function components(string $repo)
    {
        return new Components($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\DefaultReviewers
     */
    public function defaultReviewers(string $repo)
    {
        return new DefaultReviewers($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\DeployKeys
     */
    public function deployKeys(string $repo)
    {
        return new DeployKeys($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Deployments
     */
    public function deployments(string $repo)
    {
        return new Deployments($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Diffs
     */
    public function diffs(string $repo)
    {
        return new Diffs($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\DiffStat
     */
    public function diffStat(string $repo)
    {
        return new DiffStat($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Downloads
     */
    public function downloads(string $repo)
    {
        return new Downloads($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Environments
     */
    public function environments(string $repo)
    {
        return new Environments($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\FileHistory
     */
    public function fileHistory(string $repo)
    {
        return new FileHistory($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Forks
     */
    public function forks(string $repo)
    {
        return new Forks($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Hooks
     */
    public function hooks(string $repo)
    {
        return new Hooks($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Issues
     */
    public function issues(string $repo)
    {
        return new Issues($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\MergeBases
     */
    public function mergeBases(string $repo)
    {
        return new MergeBases($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Milestones
     */
    public function milestones(string $repo)
    {
        return new Milestones($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Patches
     */
    public function patches(string $repo)
    {
        return new Patches($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Pipelines
     */
    public function pipelines(string $repo)
    {
        return new Pipelines($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PipelinesConfig
     */
    public function pipelinesConfig(string $repo)
    {
        return new PipelinesConfig($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Properties
     */
    public function properties(string $repo)
    {
        return new Properties($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests
     */
    public function pullRequests(string $repo)
    {
        return new PullRequests($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Refs
     */
    public function refs(string $repo)
    {
        return new Refs($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Src
     */
    public function src(string $repo)
    {
        return new Src($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Versions
     */
    public function versions(string $repo)
    {
        return new Versions($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Watchers
     */
    public function watchers(string $repo)
    {
        return new Watchers($this->getClient(), $this->workspace, $repo);
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
        return UriBuilder::build('repositories', $this->workspace, ...$parts);
    }
}
