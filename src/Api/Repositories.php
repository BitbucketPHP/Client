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

use Bitbucket\Api\Repository\BranchRestrictions;
use Bitbucket\Api\Repository\Commit;
use Bitbucket\Api\Repository\Commits;
use Bitbucket\Api\Repository\Components;
use Bitbucket\Api\Repository\DefaultReviewers;
use Bitbucket\Api\Repository\Diff;
use Bitbucket\Api\Repository\Downloads;
use Bitbucket\Api\Repository\FileHistory;
use Bitbucket\Api\Repository\Forks;
use Bitbucket\Api\Repository\Hooks;

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
     * @return \Bitbucket\Api\Repository\BranchRestrictions
     */
    public function branchRestrictions(string $username, string $repo)
    {
        return new BranchRestrictions($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repository\Commit
     */
    public function commit(string $username, string $repo)
    {
        return new Commit($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repository\Commits
     */
    public function commits(string $username, string $repo)
    {
        return new Commits($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repository\Components
     */
    public function components(string $username, string $repo)
    {
        return new Components($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repository\DefaultReviewers
     */
    public function defaultReviewers(string $username, string $repo)
    {
        return new DefaultReviewers($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repository\Diff
     */
    public function diff(string $username, string $repo)
    {
        return new Diff($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repository\Downloads
     */
    public function downloads(string $username, string $repo)
    {
        return new Downloads($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repository\FileHistory
     */
    public function fileHistory(string $username, string $repo)
    {
        return new FileHistory($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repository\Forks
     */
    public function forks(string $username, string $repo)
    {
        return new Forks($this->getHttpClient(), $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repository\Hooks
     */
    public function hooks(string $username, string $repo)
    {
        return new Hooks($this->getHttpClient(), $username, $repo);
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
