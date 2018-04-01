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
 * The branch restrictions api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Commits extends AbstractUsersApi
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
        $path = $this->buildCommitsPath();

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
    public function show(string $commit, array $params = [])
    {
        $path = $this->buildCommitsPath($commit);

        return $this->get($path, $params);
    }

    /**
     * Build the commits path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildCommitsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'commits', ...$parts);
    }
}
