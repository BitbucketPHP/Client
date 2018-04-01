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

namespace Bitbucket\Api\Repositories\Users;

/**
 * The default reviewers api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class DefaultReviewers extends AbstractUsersApi
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
        $path = $this->buildDefaultReviewersPath();

        return $this->get($path, $params);
    }

    /**
     * @param string $reviewer
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $reviewer, array $params = [])
    {
        $path = $this->buildDefaultReviewersPath($reviewer);

        return $this->get($path, $params);
    }

    /**
     * @param string $reviewer
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function add(string $reviewer, array $params = [])
    {
        $path = $this->buildDefaultReviewersPath($reviewer);

        return $this->put($path, $params);
    }

    /**
     * @param string $reviewer
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $reviewer, array $params = [])
    {
        $path = $this->buildDefaultReviewersPath($reviewer);

        return $this->delete($path, $params);
    }

    /**
     * Build the default reviewers path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildDefaultReviewersPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'default-reviewers', ...$parts);
    }
}
