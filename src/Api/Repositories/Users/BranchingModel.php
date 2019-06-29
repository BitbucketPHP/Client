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
 * The branching model api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class BranchingModel extends AbstractUsersApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(array $params = [])
    {
        $path = $this->buildBranchingModelPath();

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function showSettings(array $params = [])
    {
        $path = $this->buildBranchingModelPath('settings');

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function updateSettings(array $params = [])
    {
        $path = $this->buildBranchingModelPath('settings');

        return $this->put($path, $params);
    }

    /**
     * Build the branching model path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildBranchingModelPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'branching-model', ...$parts);
    }
}
