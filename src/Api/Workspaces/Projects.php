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

namespace Bitbucket\Api\Workspaces;

use Bitbucket\Api\Workspaces\Projects\PermissionsConfig;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The projects API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Projects extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildProjectsUri());

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildProjectsUri());

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $project, array $params = []): array
    {
        $uri = $this->buildProjectsUri($project);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $project, array $params = []): array
    {
        $uri = $this->buildProjectsUri($project);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $project, array $params = []): array
    {
        $uri = $this->buildProjectsUri($project);

        return $this->delete($uri, $params);
    }

    public function permissionsConfig(string $project): PermissionsConfig
    {
        return new PermissionsConfig($this->getClient(), $this->workspace, $project);
    }

    /**
     * Build the projects URI from the given parts.
     */
    protected function buildProjectsUri(string ...$parts): string
    {
        return UriBuilder::build('workspaces', $this->workspace, 'projects', ...$parts);
    }
}
