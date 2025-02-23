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

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\Api\Repositories\Workspaces\Deployments\EnvironmentVariables;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The deployments API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Deployments extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildDeploymentsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $deployments, array $params = []): array
    {
        $uri = $this->buildDeploymentsUri($deployments);

        return $this->get($uri, $params);
    }

    public function environmentVariables(string $environment): EnvironmentVariables
    {
        return new EnvironmentVariables($this->getClient(), $this->workspace, $this->repo, $environment);
    }

    /**
     * Build the deployments URI from the given parts.
     */
    protected function buildDeploymentsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'deployments', ...$parts);
    }
}
