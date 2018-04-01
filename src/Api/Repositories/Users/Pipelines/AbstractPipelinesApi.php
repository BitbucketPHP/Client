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

namespace Bitbucket\Api\Repositories\Users\Pipelines;

use Bitbucket\Api\Repositories\Users\AbstractUsersApi;
use Http\Client\Common\HttpMethodsClient;

/**
 * The abstract pipelines api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractPipelinesApi extends AbstractUsersApi
{
    /**
     * The pipeline.
     *
     * @var string
     */
    protected $pipeline;

    /**
     * Create a new api instance.
     *
     * @param \Http\Client\Common\HttpMethodsClient $client
     * @param string                                $username
     * @param string                                $repo
     * @param string                                $pipeline
     */
    public function __construct(HttpMethodsClient $client, string $username, string $repo, string $pipeline)
    {
        parent::__construct($client, $username, $repo);
        $this->pipeline = $pipeline;
    }
}
