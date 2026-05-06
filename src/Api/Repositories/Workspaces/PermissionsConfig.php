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

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\Api\Repositories\Workspaces\PermissionsConfig\Groups;
use Bitbucket\Api\Repositories\Workspaces\PermissionsConfig\Users;

/**
 * The permissions config API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class PermissionsConfig extends AbstractWorkspacesApi
{
    public function groups(): Groups
    {
        return new Groups($this->getClient(), $this->workspace, $this->repo);
    }

    public function users(): Users
    {
        return new Users($this->getClient(), $this->workspace, $this->repo);
    }
}
