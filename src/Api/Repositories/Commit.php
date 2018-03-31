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

/**
 * The commit api class.
 *
 * @author Graham Campbell <graham@alt-thre.com>
 */
class Commit extends AbstractRepositoryApi
{
    /**
     * @param string $commit
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function approveChanges(string $commit, array $params = [])
    {
        $path = $this->buildCommitPath($commit, 'approve');

        return $this->post($path, $params);
    }

    /**
     * @param string $commit
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function redactApproval(string $commit, array $params = [])
    {
        $path = $this->buildCommitPath($commit, 'approve');

        return $this->delete($path, $params);
    }

    /**
     * @param string $commit
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function createBuildStatus(string $commit, array $params = [])
    {
        $path = $this->buildCommitPath($commit, 'statuses', 'build');

        return $this->post($path, $params);
    }

    /**
     * @param string $commit
     * @param string $key
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function showBuildStatus(string $commit, string $key, array $params = [])
    {
        $path = $this->buildCommitPath($commit, 'statuses', 'build', $key);

        return $this->get($path, $params);
    }

    /**
     * @param string $commit
     * @param string $key
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function updateBuildStatus(string $commit, string $key, array $params = [])
    {
        $path = $this->buildCommitPath($commit, 'statuses', 'build', $key);

        return $this->put($path, $params);
    }

    /**
     * @param string $commit
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $commit, array $params = [])
    {
        $path = $this->buildCommitPath($commit);

        return $this->get($path, $params);
    }

    /**
     * @param string $commit
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listComments(string $commit, array $params = [])
    {
        $path = $this->buildCommitPath($commit, 'comments');

        return $this->get($path, $params);
    }

    /**
     * @param string $commit
     * @param string $comment
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function showComment(string $commit, string $comment, array $params = [])
    {
        $path = $this->buildCommitPath($commit, 'comments', $comment);

        return $this->get($path, $params);
    }

    /**
     * Build the commit path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildCommitPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'commit', ...$parts);
    }
}
