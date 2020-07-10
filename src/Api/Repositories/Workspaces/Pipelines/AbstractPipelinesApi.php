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

namespace Bitbucket\Api\Repositories\Workspaces\Pipelines;

use Bitbucket\Api\Repositories\Workspaces\AbstractWorkspacesApi;
use Bitbucket\Client;

/**
 * The abstract pipelines api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractPipelinesApi extends AbstractWorkspacesApi
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
     * @param Client $client
     * @param string $workspace
     * @param string $repo
     * @param string $pipeline
     */
    public function __construct(Client $client, string $workspace, string $repo, string $pipeline)
    {
        parent::__construct($client, $workspace, $repo);
        $this->pipeline = $pipeline;
    }
}
