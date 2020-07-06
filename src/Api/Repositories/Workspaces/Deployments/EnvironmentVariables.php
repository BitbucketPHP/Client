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

use Bitbucket\HttpClient\Util\UriBuilder;

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
        $uri = $this->buildEnvironmentVariablesUri();

        return $this->get($uri, $params);
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
        $uri = $this->buildEnvironmentVariablesUri();

        return $this->post($uri, $params);
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
        $uri = $this->buildEnvironmentVariablesUri($variable);

        return $this->put($uri, $params);
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
        $uri = $this->buildEnvironmentVariablesUri($variable);

        return $this->delete($uri, $params);
    }

    /**
     * Build the variables URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildEnvironmentVariablesUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'deployments_config', 'environments', $this->environment, 'variables', ...$parts);
    }
}
