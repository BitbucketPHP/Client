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

use Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\AbstractPipelinesConfigApi;
use Bitbucket\Client;

/**
 * The abstract schedules API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
abstract class AbstractSchedulesApi extends AbstractPipelinesConfigApi
{
    /**
     * The schedule.
     *
     * @var string
     */
    protected $schedule;

    /**
     * Create a new API instance.
     *
     * @param Client $client
     * @param string $workspace
     * @param string $repo
     * @param string $schedule
     *
     * @return void
     */
    public function __construct(Client $client, string $workspace, string $repo, string $schedule)
    {
        parent::__construct($client, $workspace, $repo);
        $this->schedule = $schedule;
    }
}
