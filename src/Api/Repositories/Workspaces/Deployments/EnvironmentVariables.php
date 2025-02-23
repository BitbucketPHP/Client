<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api\Repositories\Workspaces\Deployments;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The environment ariables API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class EnvironmentVariables extends AbstractDeploymentsApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildEnvironmentVariablesUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildEnvironmentVariablesUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $variable, array $params = []): array
    {
        $uri = $this->buildEnvironmentVariablesUri($variable);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $variable, array $params = []): array
    {
        $uri = $this->buildEnvironmentVariablesUri($variable);

        return $this->delete($uri, $params);
    }

    /**
     * Build the variables URI from the given parts.
     */
    protected function buildEnvironmentVariablesUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'deployments_config', 'environments', $this->environment, 'variables', ...$parts);
    }
}
