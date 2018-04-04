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

namespace Bitbucket\Api\Repositories\Users\Commit\Statuses;

/**
 * The build api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Build extends AbstractStatusesApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $path = $this->buildBuildPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $key
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $key, array $params = [])
    {
        $path = $this->buildBuildPath(...explode('/', $key));

        return $this->get($path, $params);
    }

    /**
     * @param string $key
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $key, array $params = [])
    {
        $path = $this->buildBuildPath(...explode('/', $key));

        return $this->put($path, $params);
    }

    /**
     * Build the build path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildBuildPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'commit', $this->commit, 'statuses', 'build', ...$parts);
    }
}
