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
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The schedules API class.
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
        $uri = UriBuilder::appendSeparator($this->buildSchedulesUri());

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
        $uri = UriBuilder::appendSeparator($this->buildSchedulesUri());

        return $this->post($uri, $params);
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
        $uri = $this->buildSchedulesUri($schedule);

        return $this->get($uri, $params);
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
        $uri = $this->buildSchedulesUri($schedule);

        return $this->put($uri, $params);
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
        $uri = $this->buildSchedulesUri($schedule);

        return $this->delete($uri, $params);
    }

    /**
     * @param string $schedule
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Schedules\Executions
     */
    public function executions(string $schedule)
    {
        return new Executions($this->getClient(), $this->getPerPage(), $this->workspace, $this->repo, $schedule);
    }

    /**
     * Build the schedules URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildSchedulesUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines_config', 'schedules', ...$parts);
    }
}
