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

namespace Bitbucket\Api\Repositories\Workspaces\Deployments;

/**
 * The environment ariables api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class EnvironmentVariables extends AbstractDeploymentsApi
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
        $path = $this->buildEnvironmentVariablesPath();

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
        $path = $this->buildEnvironmentVariablesPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $variable
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $variable, array $params = [])
    {
        $path = $this->buildEnvironmentVariablesPath($variable);

        return $this->put($path, $params);
    }

    /**
     * @param string $variable
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $variable, array $params = [])
    {
        $path = $this->buildEnvironmentVariablesPath($variable);

        return $this->delete($path, $params);
    }

    /**
     * Build the variables path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildEnvironmentVariablesPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'deployments_config', 'environments', $this->environment, 'variables', ...$parts);
    }
}
