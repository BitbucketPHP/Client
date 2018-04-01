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

use Bitbucket\Api\Repositories\Users\BranchRestrictions;
use Bitbucket\Api\Repositories\Users\Commit;
use Bitbucket\Api\Repositories\Users\Commits;
use Bitbucket\Api\Repositories\Users\Components;
use Bitbucket\Api\Repositories\Users\DefaultReviewers;
use Bitbucket\Api\Repositories\Users\Diffs;
use Bitbucket\Api\Repositories\Users\Downloads;
use Bitbucket\Api\Repositories\Users\FileHistory;
use Bitbucket\Api\Repositories\Users\Forks;
use Bitbucket\Api\Repositories\Users\Hooks;
use Bitbucket\Api\Repositories\Users\Issues;
use Bitbucket\Api\Repositories\Users\Milestones;
use Bitbucket\Api\Repositories\Users\Patches;
use Bitbucket\Api\Repositories\Users\Pipelines;
use Bitbucket\Api\Repositories\Users\PipelinesConfig;
use Bitbucket\Api\Repositories\Users\Properties;
use Bitbucket\Api\Repositories\Users\PullRequests;
use Bitbucket\Api\Repositories\Users\Refs;
use Bitbucket\Api\Repositories\Users\Src;
use Bitbucket\Api\Repositories\Users\Versions;
use Bitbucket\Api\Repositories\Users\Watchers;

/**
 * The users api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Users extends AbstractRepositoriesApi
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
        $path = $this->buildUsersPath();

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
        $path = $this->buildUsersPath($repo);

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
        $path = $this->buildUsersPath($repo);

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
        $path = $this->buildUsersPath($repo);

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
        $path = $this->buildUsersPath($repo);

        return $this->delete($path, $params);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\BranchRestrictions
     */
    public function branchRestrictions(string $repo)
    {
        return new BranchRestrictions($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Commit
     */
    public function commit(string $repo)
    {
        return new Commit($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Commits
     */
    public function commits(string $repo)
    {
        return new Commits($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Components
     */
    public function components(string $repo)
    {
        return new Components($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\DefaultReviewers
     */
    public function defaultReviewers(string $repo)
    {
        return new DefaultReviewers($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Diffs
     */
    public function diffs(string $repo)
    {
        return new Diffs($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Downloads
     */
    public function downloads(string $repo)
    {
        return new Downloads($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\FileHistory
     */
    public function fileHistory(string $repo)
    {
        return new FileHistory($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Forks
     */
    public function forks(string $repo)
    {
        return new Forks($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Hooks
     */
    public function hooks(string $repo)
    {
        return new Hooks($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Issues
     */
    public function issues(string $repo)
    {
        return new Issues($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Milestones
     */
    public function milestones(string $repo)
    {
        return new Milestones($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Patches
     */
    public function patches(string $repo)
    {
        return new Patches($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Pipelines
     */
    public function pipelines(string $repo)
    {
        return new Pipelines($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\PipelinesConfig
     */
    public function pipelinesConfig(string $repo)
    {
        return new PipelinesConfig($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Properties
     */
    public function properties(string $repo)
    {
        return new Properties($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\PullRequests
     */
    public function pullRequests(string $repo)
    {
        return new PullRequests($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Refs
     */
    public function refs(string $repo)
    {
        return new Refs($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Src
     */
    public function src(string $repo)
    {
        return new Src($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Versions
     */
    public function versions(string $repo)
    {
        return new Versions($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Users\Watchers
     */
    public function watchers(string $repo)
    {
        return new Watchers($this->getHttpClient(), $this->username, $repo);
    }

    /**
     * Build the users path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildUsersPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, ...$parts);
    }
}
