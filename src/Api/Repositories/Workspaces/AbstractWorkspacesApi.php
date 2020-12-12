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

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\Api\Repositories\AbstractRepositoriesApi;
use Bitbucket\Client;

/**
 * The abstract workspaces API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractWorkspacesApi extends AbstractRepositoriesApi
{
    /**
     * The repo.
     *
     * @var string
     */
    protected $repo;

    /**
     * Create a new API instance.
     *
     * @param Client   $client
     * @param string   $workspace
     * @param string   $repo
     *
     * @return void
     */
    public function __construct(Client $client, string $workspace, string $repo)
    {
        parent::__construct($client, $workspace);
        $this->repo = $repo;
    }
}
