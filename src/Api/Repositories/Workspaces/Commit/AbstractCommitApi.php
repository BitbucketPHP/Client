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

namespace Bitbucket\Api\Repositories\Workspaces\Commit;

use Bitbucket\Api\Repositories\Workspaces\AbstractWorkspacesApi;
use Bitbucket\Client;

/**
 * The abstract commit API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
abstract class AbstractCommitApi extends AbstractWorkspacesApi
{
    /**
     * The commit.
     *
     * @var string
     */
    protected $commit;

    /**
     * Create a new API instance.
     *
     * @param Client $client
     * @param string $workspace
     * @param string $repo
     * @param string $commit
     *
     * @return void
     */
    public function __construct(Client $client, string $workspace, string $repo, string $commit)
    {
        parent::__construct($client, $workspace, $repo);
        $this->commit = $commit;
    }
}
