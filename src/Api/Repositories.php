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

use Bitbucket\Api\Repositories\BranchRestrictions;
use Bitbucket\Api\Repositories\Commit;
use Bitbucket\Api\Repositories\Commits;
use Bitbucket\Api\Repositories\Components;
use Bitbucket\Api\Repositories\DefaultReviewers;
use Bitbucket\Api\Repositories\Diffs;
use Bitbucket\Api\Repositories\Downloads;
use Bitbucket\Api\Repositories\FileHistory;
use Bitbucket\Api\Repositories\Forks;
use Bitbucket\Api\Repositories\Hooks;
use Bitbucket\Api\Repositories\Issues;
use Bitbucket\Api\Repositories\Milestones;
use Bitbucket\Api\Repositories\Patches;

/**
 * The repositories api class.
 *
 * @author Graham Campbell <graham@alt-thre.com>
 */
class Repositories extends AbstractApi
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
        $path = $this->buildRepositoriesPath();

        return $this->get($path, $params);
    }

    /**
     * @param string $username
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listFor(string $username, array $params = [])
    {
        $path = $this->buildRepositoriesPath($username);

        return $this->get($path, $params);
    }

    /**
     * @param string $username
     * @param string $repo
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $username, string $repo, array $params = [])
    {
        $path = $this->buildRepositoriesPath($username, $repo);

        return $this->get($path, $params);
    }

    /**
     * @param string $username
     * @param string $repo
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(string $username, string $repo, array $params = [])
    {
        $path = $this->buildRepositoriesPath($username, $repo);

        return $this->post($path, $params);
    }

    /**
     * @param string $username
     * @param string $repo
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $username, string $repo, array $params = [])
    {
        $path = $this->buildRepositoriesPath($username, $repo);

        return $this->put($path, $params);
    }

    /**
     * @param string $username
     * @param string $repo
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $username, string $repo, array $params = [])
    {
        $path = $this->buildRepositoriesPath($username, $repo);

        return $this->delete($path, $params);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\BranchRestrictions
     */
    public function branchRestrictions(string $username, string $repo)
    {
        return new BranchRestrictions($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Commit
     */
    public function commit(string $username, string $repo)
    {
        return new Commit($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Commits
     */
    public function commits(string $username, string $repo)
    {
        return new Commits($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Components
     */
    public function components(string $username, string $repo)
    {
        return new Components($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\DefaultReviewers
     */
    public function defaultReviewers(string $username, string $repo)
    {
        return new DefaultReviewers($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Diffs
     */
    public function diff(string $username, string $repo)
    {
        return new Diffs($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Downloads
     */
    public function downloads(string $username, string $repo)
    {
        return new Downloads($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\FileHistory
     */
    public function fileHistory(string $username, string $repo)
    {
        return new FileHistory($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Forks
     */
    public function forks(string $username, string $repo)
    {
        return new Forks($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Hooks
     */
    public function hooks(string $username, string $repo)
    {
        return new Hooks($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Issues
     */
    public function issues(string $username, string $repo)
    {
        return new Issues($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Milestones
     */
    public function milestones(string $username, string $repo)
    {
        return new Milestones($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repositories\Patches
     */
    public function patches(string $username, string $repo)
    {
        return new Patches($this->getHttpClient(), $username, $repo);
    }

    /**
     * Build the repositories path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildRepositoriesPath(string ...$parts)
    {
        return static::buildPath('repositories', ...$parts);
    }
}
