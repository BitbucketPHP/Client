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

namespace Bitbucket\Api\Repositories\Workspaces\Deployments;

use Bitbucket\Api\Repositories\Workspaces\AbstractWorkspacesApi;
use Bitbucket\Client;

/**
 * The abstract deployments API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractDeploymentsApi extends AbstractWorkspacesApi
{
    /**
     * The environment.
     *
     * @var string
     */
    protected $environment;

    /**
     * Create a new API instance.
     *
     * @param Client   $client
     * @param int|null $perPage
     * @param string   $workspace
     * @param string   $repo
     * @param string   $environment
     */
    public function __construct(Client $client, ?int $perPage, string $workspace, string $repo, string $environment)
    {
        parent::__construct($client, $perPage, $workspace, $repo);
        $this->environment = $environment;
    }
}
