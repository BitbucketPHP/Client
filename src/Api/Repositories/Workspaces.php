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
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildWorkspacesUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $repo, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($repo);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(string $repo, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($repo);

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $repo, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($repo);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $repo, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($repo);

        return $this->delete($uri, $params);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\BranchingModel
     */
    public function branchingModel(string $repo): \Bitbucket\Api\Repositories\Workspaces\BranchingModel
    {
        return new BranchingModel($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\BranchRestrictions
     */
    public function branchRestrictions(string $repo): \Bitbucket\Api\Repositories\Workspaces\BranchRestrictions
    {
        return new BranchRestrictions($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Commit
     */
    public function commit(string $repo): \Bitbucket\Api\Repositories\Workspaces\Commit
    {
        return new Commit($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Commits
     */
    public function commits(string $repo): \Bitbucket\Api\Repositories\Workspaces\Commits
    {
        return new Commits($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Components
     */
    public function components(string $repo): \Bitbucket\Api\Repositories\Workspaces\Components
    {
        return new Components($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\DefaultReviewers
     */
    public function defaultReviewers(string $repo): \Bitbucket\Api\Repositories\Workspaces\DefaultReviewers
    {
        return new DefaultReviewers($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\DeployKeys
     */
    public function deployKeys(string $repo): \Bitbucket\Api\Repositories\Workspaces\DeployKeys
    {
        return new DeployKeys($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Deployments
     */
    public function deployments(string $repo): \Bitbucket\Api\Repositories\Workspaces\Deployments
    {
        return new Deployments($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Diffs
     */
    public function diffs(string $repo): \Bitbucket\Api\Repositories\Workspaces\Diffs
    {
        return new Diffs($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\DiffStat
     */
    public function diffStat(string $repo): \Bitbucket\Api\Repositories\Workspaces\DiffStat
    {
        return new DiffStat($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Downloads
     */
    public function downloads(string $repo): \Bitbucket\Api\Repositories\Workspaces\Downloads
    {
        return new Downloads($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Environments
     */
    public function environments(string $repo): \Bitbucket\Api\Repositories\Workspaces\Environments
    {
        return new Environments($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\FileHistory
     */
    public function fileHistory(string $repo): \Bitbucket\Api\Repositories\Workspaces\FileHistory
    {
        return new FileHistory($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Forks
     */
    public function forks(string $repo): \Bitbucket\Api\Repositories\Workspaces\Forks
    {
        return new Forks($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Hooks
     */
    public function hooks(string $repo): \Bitbucket\Api\Repositories\Workspaces\Hooks
    {
        return new Hooks($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Issues
     */
    public function issues(string $repo): \Bitbucket\Api\Repositories\Workspaces\Issues
    {
        return new Issues($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\MergeBases
     */
    public function mergeBases(string $repo): \Bitbucket\Api\Repositories\Workspaces\MergeBases
    {
        return new MergeBases($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Milestones
     */
    public function milestones(string $repo): \Bitbucket\Api\Repositories\Workspaces\Milestones
    {
        return new Milestones($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Patches
     */
    public function patches(string $repo): \Bitbucket\Api\Repositories\Workspaces\Patches
    {
        return new Patches($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Pipelines
     */
    public function pipelines(string $repo): \Bitbucket\Api\Repositories\Workspaces\Pipelines
    {
        return new Pipelines($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PipelinesConfig
     */
    public function pipelinesConfig(string $repo): \Bitbucket\Api\Repositories\Workspaces\PipelinesConfig
    {
        return new PipelinesConfig($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Properties
     */
    public function properties(string $repo): \Bitbucket\Api\Repositories\Workspaces\Properties
    {
        return new Properties($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests
     */
    public function pullRequests(string $repo): \Bitbucket\Api\Repositories\Workspaces\PullRequests
    {
        return new PullRequests($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Refs
     */
    public function refs(string $repo): \Bitbucket\Api\Repositories\Workspaces\Refs
    {
        return new Refs($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Src
     */
    public function src(string $repo): \Bitbucket\Api\Repositories\Workspaces\Src
    {
        return new Src($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Versions
     */
    public function versions(string $repo): \Bitbucket\Api\Repositories\Workspaces\Versions
    {
        return new Versions($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Watchers
     */
    public function watchers(string $repo): \Bitbucket\Api\Repositories\Workspaces\Watchers
    {
        return new Watchers($this->getClient(), $this->workspace, $repo);
    }

    /**
     * Build the workspaces URI from the given parts.
     *
     * @return string
     */
    protected function buildWorkspacesUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, ...$parts);
    }
}
