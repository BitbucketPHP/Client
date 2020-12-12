<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Schedules;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The executions API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Executions extends AbstractSchedulesApi
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
        $uri = UriBuilder::appendSeparator($this->buildExecutionsUri());

        return $this->get($uri, $params);
    }

    /**
     * Build the executions URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildExecutionsUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines_config', 'schedules', $this->schedule, 'executions', ...$parts);
    }
}
