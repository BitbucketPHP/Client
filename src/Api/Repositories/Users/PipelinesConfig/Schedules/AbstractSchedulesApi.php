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

namespace Bitbucket\Api\Repositories\Users\PipelinesConfig\Schedules;

use Bitbucket\Api\Repositories\Users\PipelinesConfig\AbstractPipelinesConfigApi;
use Http\Client\Common\HttpMethodsClient;

/**
 * The abstract schedules api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
     * Create a new api instance.
     *
     * @param \Http\Client\Common\HttpMethodsClient $client
     * @param string                                $username
     * @param string                                $repo
     * @param string                                $schedule
     */
    public function __construct(HttpMethodsClient $client, string $username, string $repo, string $schedule)
    {
        parent::__construct($client, $username, $repo);
        $this->schedule = $schedule;
    }
}
