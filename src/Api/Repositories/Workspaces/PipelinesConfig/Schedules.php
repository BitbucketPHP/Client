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

namespace Bitbucket\Api\Repositories\Workspaces\PipelinesConfig;

use Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Schedules\Executions;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The schedules API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Schedules extends AbstractPipelinesConfigApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildSchedulesUri());

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildSchedulesUri());

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $schedule, array $params = []): array
    {
        $uri = $this->buildSchedulesUri($schedule);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $schedule, array $params = []): array
    {
        $uri = $this->buildSchedulesUri($schedule);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $schedule, array $params = []): array
    {
        $uri = $this->buildSchedulesUri($schedule);

        return $this->delete($uri, $params);
    }

    public function executions(string $schedule): Executions
    {
        return new Executions($this->getClient(), $this->workspace, $this->repo, $schedule);
    }

    /**
     * Build the schedules URI from the given parts.
     */
    protected function buildSchedulesUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines_config', 'schedules', ...$parts);
    }
}
