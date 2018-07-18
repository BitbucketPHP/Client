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

namespace Bitbucket\Api\Repositories\Users\Refs;

/**
 * The branches api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Branches extends AbstractRefsApi
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
        $path = $this->buildBranchesPath();

        return $this->get($path, $params);
    }

    /**
     * @param string $branch
     * @param string $target
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(string $branch, string $target)
    {
        $path = $this->buildBranchesPath();

        $params = [
            'name'   => $branch,
            'target' => [
                'hash' => $target,
            ],
        ];

        return $this->post($path, $params);
    }

    /**
     * @param string $branch
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $branch, array $params = [])
    {
        $path = $this->buildBranchesPath($branch);

        return $this->get($path, $params);
    }

    /**
     * Build the branches path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildBranchesPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'refs', 'branches', ...$parts);
    }
}
