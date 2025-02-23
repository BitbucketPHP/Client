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

namespace Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Schedules;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The executions API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Executions extends AbstractSchedulesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildExecutionsUri());

        return $this->get($uri, $params);
    }

    /**
     * Build the executions URI from the given parts.
     */
    protected function buildExecutionsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines_config', 'schedules', $this->schedule, 'executions', ...$parts);
    }
}
