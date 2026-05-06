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

namespace Bitbucket\Api\Workspaces\Projects;

use Bitbucket\Api\Workspaces\AbstractWorkspacesApi;
use Bitbucket\Client;

/**
 * The abstract projects API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
abstract class AbstractProjectsApi extends AbstractWorkspacesApi
{
    protected readonly string $project;

    public function __construct(Client $client, string $workspace, string $project)
    {
        parent::__construct($client, $workspace);
        $this->project = $project;
    }
}
