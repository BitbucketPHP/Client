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
use Bitbucket\Api\Repositories\Workspaces\EffectiveBranchingModel;
use Bitbucket\Api\Repositories\Workspaces\Environments;
use Bitbucket\Api\Repositories\Workspaces\FileHistory;
use Bitbucket\Api\Repositories\Workspaces\Forks;
use Bitbucket\Api\Repositories\Workspaces\Hooks;
use Bitbucket\Api\Repositories\Workspaces\Issues;
use Bitbucket\Api\Repositories\Workspaces\MergeBases;
use Bitbucket\Api\Repositories\Workspaces\Milestones;
use Bitbucket\Api\Repositories\Workspaces\Patches;
use Bitbucket\Api\Repositories\Workspaces\PermissionsConfig;
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
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildWorkspacesUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $repo, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($repo);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(string $repo, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($repo);

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $repo, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($repo);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $repo, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($repo);

        return $this->delete($uri, $params);
    }

    public function branchingModel(string $repo): BranchingModel
    {
        return new BranchingModel($this->getClient(), $this->workspace, $repo);
    }

    public function effectiveBranchingModel(string $repo): EffectiveBranchingModel
    {
        return new EffectiveBranchingModel($this->getClient(), $this->workspace, $repo);
    }

    public function branchRestrictions(string $repo): BranchRestrictions
    {
        return new BranchRestrictions($this->getClient(), $this->workspace, $repo);
    }

    public function commit(string $repo): Commit
    {
        return new Commit($this->getClient(), $this->workspace, $repo);
    }

    public function commits(string $repo): Commits
    {
        return new Commits($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function components(string $repo): Components
    {
        return new Components($this->getClient(), $this->workspace, $repo);
    }

    public function defaultReviewers(string $repo): DefaultReviewers
    {
        return new DefaultReviewers($this->getClient(), $this->workspace, $repo);
    }

    public function deployKeys(string $repo): DeployKeys
    {
        return new DeployKeys($this->getClient(), $this->workspace, $repo);
    }

    public function deployments(string $repo): Deployments
    {
        return new Deployments($this->getClient(), $this->workspace, $repo);
    }

    public function diffs(string $repo): Diffs
    {
        return new Diffs($this->getClient(), $this->workspace, $repo);
    }

    public function diffStat(string $repo): DiffStat
    {
        return new DiffStat($this->getClient(), $this->workspace, $repo);
    }

    public function downloads(string $repo): Downloads
    {
        return new Downloads($this->getClient(), $this->workspace, $repo);
    }

    public function environments(string $repo): Environments
    {
        return new Environments($this->getClient(), $this->workspace, $repo);
    }

    public function fileHistory(string $repo): FileHistory
    {
        return new FileHistory($this->getClient(), $this->workspace, $repo);
    }

    public function forks(string $repo): Forks
    {
        return new Forks($this->getClient(), $this->workspace, $repo);
    }

    public function hooks(string $repo): Hooks
    {
        return new Hooks($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function issues(string $repo): Issues
    {
        return new Issues($this->getClient(), $this->workspace, $repo);
    }

    public function mergeBases(string $repo): MergeBases
    {
        return new MergeBases($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function milestones(string $repo): Milestones
    {
        return new Milestones($this->getClient(), $this->workspace, $repo);
    }

    public function patches(string $repo): Patches
    {
        return new Patches($this->getClient(), $this->workspace, $repo);
    }

    public function permissionsConfig(string $repo): PermissionsConfig
    {
        return new PermissionsConfig($this->getClient(), $this->workspace, $repo);
    }

    public function pipelines(string $repo): Pipelines
    {
        return new Pipelines($this->getClient(), $this->workspace, $repo);
    }

    public function pipelinesConfig(string $repo): PipelinesConfig
    {
        return new PipelinesConfig($this->getClient(), $this->workspace, $repo);
    }

    public function properties(string $repo): Properties
    {
        return new Properties($this->getClient(), $this->workspace, $repo);
    }

    public function pullRequests(string $repo): PullRequests
    {
        return new PullRequests($this->getClient(), $this->workspace, $repo);
    }

    public function refs(string $repo): Refs
    {
        return new Refs($this->getClient(), $this->workspace, $repo);
    }

    public function src(string $repo): Src
    {
        return new Src($this->getClient(), $this->workspace, $repo);
    }

    /**
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function versions(string $repo): Versions
    {
        return new Versions($this->getClient(), $this->workspace, $repo);
    }

    public function watchers(string $repo): Watchers
    {
        return new Watchers($this->getClient(), $this->workspace, $repo);
    }

    /**
     * Build the workspaces URI from the given parts.
     */
    protected function buildWorkspacesUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, ...$parts);
    }
}
