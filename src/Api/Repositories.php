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
        return new BranchRestrictions($this->client, $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repository\Commit
     */
    public function commit(string $username, string $repo)
    {
        return new Commit($this->client, $username, $repo);
    }

    /**
     * @param string $username
     * @param string $repo
     *
     * @return \Bitbucket\Api\Repository\Commits
     */
    public function commits(string $username, string $repo)
    {
        return new Commits($this->client, $username, $repo);
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
