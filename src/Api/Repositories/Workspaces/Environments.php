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

namespace Bitbucket\Api\Repositories\Workspaces;

/**
 * The environments api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Environments extends AbstractWorkspacesApi
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
        $path = $this->buildEnvironmentsPath();

        return $this->get($path, $params);
    }

    /**
     * @param string $env
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $env, array $params = [])
    {
        $path = $this->buildEnvironmentsPath($env);

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
        $path = $this->buildEnvironmentsPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $env
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $env, array $params = [])
    {
        $path = static::appendSeparator($this->buildEnvironmentsPath($env, 'changes'));

        return $this->put($path, $params);
    }

    /**
     * @param string $env
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $env)
    {
        $path = $this->buildEnvironmentsPath($env);

        return $this->delete($path);
    }

    /**
     * Build the environments path from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildEnvironmentsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'environments', ...$parts);
    }
}
