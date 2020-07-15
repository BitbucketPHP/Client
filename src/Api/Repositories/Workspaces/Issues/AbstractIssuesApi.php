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

namespace Bitbucket\Api\Repositories\Workspaces\Issues;

use Bitbucket\Api\Repositories\Workspaces\AbstractWorkspacesApi;
use Bitbucket\Client;

/**
 * The abstract issues API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractIssuesApi extends AbstractWorkspacesApi
{
    /**
     * The issue.
     *
     * @var string
     */
    protected $issue;

    /**
     * Create a new API instance.
     *
     * @param Client   $client
     * @param string   $workspace
     * @param string   $repo
     * @param string   $issue
     * @param int|null $perPage
     *
     * @return void
     */
    public function __construct(Client $client, string $workspace, string $repo, string $issue, int $perPage = null)
    {
        parent::__construct($client, $workspace, $repo, $perPage);
        $this->issue = $issue;
    }
}
