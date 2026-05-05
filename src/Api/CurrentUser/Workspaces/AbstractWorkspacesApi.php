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

namespace Bitbucket\Api\CurrentUser\Workspaces;

use Bitbucket\Api\CurrentUser\AbstractCurrentUserApi;
use Bitbucket\Client;

/**
 * The abstract workspaces API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
abstract class AbstractWorkspacesApi extends AbstractCurrentUserApi
{
    protected readonly string $workspace;

    public function __construct(Client $client, string $workspace)
    {
        parent::__construct($client);
        $this->workspace = $workspace;
    }
}
