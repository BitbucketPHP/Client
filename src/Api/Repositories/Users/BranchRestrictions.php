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
class BranchRestrictions extends AbstractUsersApi
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
        $path = $this->buildBranchRestrictionsPath();

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $path = $this->buildBranchRestrictionsPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $restriction
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $restriction, array $params = [])
    {
        $path = $this->buildBranchRestrictionsPath($restriction);

        return $this->get($path, $params);
    }

    /**
     * @param string $restriction
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $restriction, array $params = [])
    {
        $path = $this->buildBranchRestrictionsPath($restriction);

        return $this->put($path, $params);
    }

    /**
     * @param string $restriction
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $restriction, array $params = [])
    {
        $path = $this->buildBranchRestrictionsPath($restriction);

        return $this->delete($path, $params);
    }

    /**
     * Build the branch restrictions path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildBranchRestrictionsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'branch-restrictions', ...$parts);
    }
}
