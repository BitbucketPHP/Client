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

namespace Bitbucket\Api\Repositories\Workspaces\PullRequests;

use Bitbucket\Api\Repositories\Workspaces\AbstractWorkspacesApi;
use Bitbucket\Client;

/**
 * The abstract pull requests API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
abstract class AbstractPullRequestsApi extends AbstractWorkspacesApi
{
    protected readonly string $pr;

    public function __construct(Client $client, string $workspace, string $repo, string $pr)
    {
        parent::__construct($client, $workspace, $repo);
        $this->pr = $pr;
    }
}
