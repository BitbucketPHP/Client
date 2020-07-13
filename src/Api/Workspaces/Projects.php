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

namespace Bitbucket\Api\Workspaces;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The projects API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Projects extends AbstractWorkspacesApi
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
        $uri = UriBuilder::appendSeparator($this->buildProjectsUri());

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
        $uri = UriBuilder::appendSeparator($this->buildProjectsUri());

        return $this->post($uri, $params);
    }

    /**
     * @param string $project
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $project, array $params = [])
    {
        $uri = $this->buildProjectsUri($project);

        return $this->get($uri, $params);
    }

    /**
     * @param string $project
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $project, array $params = [])
    {
        $uri = $this->buildProjectsUri($project);

        return $this->put($uri, $params);
    }

    /**
     * @param string $project
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $project, array $params = [])
    {
        $uri = $this->buildProjectsUri($project);

        return $this->delete($uri, $params);
    }

    /**
     * Build the projects URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildProjectsUri(string ...$parts)
    {
        return UriBuilder::build('workspaces', $this->workspace, 'projects', ...$parts);
    }
}
