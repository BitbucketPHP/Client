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

use Bitbucket\Api\Repositories\Workspaces\Deployments\EnvironmentVariables;

/**
 * The deployments api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Deployments extends AbstractWorkspacesApi
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
        $path = $this->buildDeploymentsPath();

        return $this->get($path, $params);
    }

    /**
     * @param string $deployments
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $deployments, array $params = [])
    {
        $path = $this->buildDeploymentsPath($deployments);

        return $this->get($path, $params);
    }

    /**
     * @param string $environment
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Deployments\EnvironmentVariables
     */
    public function environmentVariables(string $environment)
    {
        return new EnvironmentVariables($this->getHttpClient(), $this->workspace, $this->repo, $environment);
    }

    /**
     * Build the deployments path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildDeploymentsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'deployments', ...$parts);
    }
}
