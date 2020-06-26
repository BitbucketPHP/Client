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
        $path = $this->buildProjectsPath().static::URI_SEPARATOR;

        return $this->get($path, $params);
    }

    /**
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function all()
    {
        $projects = [];
        $page = 1;

        do {
            $project = $this->list(['page' => $page]);
            $projects = array_merge($projects, $project['values']);
            $page++;
        } while (isset($project['next']));

        return $projects;
    }

    /**
     * @param string $name
     * @param string $key
     * @param string $description
     * @param string $links
     * @param bool $is_private
     *
     * @return array
     * @throws \Http\Client\Exception
     */
    public function create(string $name, string $key, string $description, string $links, bool $is_private)
    {
        $params = [
            'name' => $name,
            'key' => $key,
            'description' => $description,
            'links' => (object)[
                'avatar' => (object)[
                    'href' => $links
                ]
            ],
            'is_private' => $is_private
        ];

        $path = $this->buildProjectsPath().static::URI_SEPARATOR;

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
        return static::buildPath('workspaces', $this->username, 'projects', ...$parts);
    }
}
