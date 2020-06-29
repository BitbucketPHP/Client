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

namespace Bitbucket\Api\Repositories\Workspaces\PipelinesConfig;

use Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Schedules\Executions;

/**
 * The schedules api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Schedules extends AbstractPipelinesConfigApi
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
        $path = $this->buildSchedulesPath().static::URI_SEPARATOR;

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
        $path = $this->buildSchedulesPath().static::URI_SEPARATOR;

        return $this->post($path, $params);
    }

    /**
     * @param string $schedule
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $schedule, array $params = [])
    {
        $path = $this->buildSchedulesPath($schedule);

        return $this->get($path, $params);
    }

    /**
     * @param string $schedule
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $schedule, array $params = [])
    {
        $path = $this->buildSchedulesPath($schedule);

        return $this->put($path, $params);
    }

    /**
     * @param string $schedule
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $schedule, array $params = [])
    {
        $path = $this->buildSchedulesPath($schedule);

        return $this->delete($path, $params);
    }

    /**
     * @param string $schedule
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Schedules\Executions
     */
    public function executions(string $schedule)
    {
        return new Executions($this->getHttpClient(), $this->workspace, $this->repo, $schedule);
    }

    /**
     * Build the schedules path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildSchedulesPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'pipelines_config', 'schedules', ...$parts);
    }
}
