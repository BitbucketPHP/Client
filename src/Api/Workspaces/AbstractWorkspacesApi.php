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

namespace Bitbucket\Api\Workspaces;

use Bitbucket\Api\AbstractApi;
use Bitbucket\Client;

/**
 * The abstract workspace API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractWorkspacesApi extends AbstractApi
{
    /**
     * The workspace.
     *
     * @var string
     */
    protected $workspace;

    /**
     * Create a new API instance.
     *
     * @param Client   $client
     * @param string   $workspace
     *
     * @return void
     */
    public function __construct(Client $client, string $workspace)
    {
        parent::__construct($client);
        $this->workspace = $workspace;
    }
}
