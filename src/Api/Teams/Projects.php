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

namespace Bitbucket\Api\Teams;

/**
 * The projects api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Projects extends AbstractTeamsApi
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
        $path = $this->buildProjectsPath();

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
        $path = $this->buildProjectsPath();

        return $this->post($path, $params);
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
        $path = $this->buildProjectsPath($project);

        return $this->get($path, $params);
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
        $path = $this->buildProjectsPath($project);

        return $this->put($path, $params);
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
        $path = $this->buildProjectsPath($project);

        return $this->delete($path, $params);
    }

    /**
     * Build the projects path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildProjectsPath(string ...$parts)
    {
        return static::buildPath('teams', $this->username, 'projects', ...$parts);
    }
}
