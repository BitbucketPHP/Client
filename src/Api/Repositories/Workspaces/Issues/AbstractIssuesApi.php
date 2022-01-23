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

namespace Bitbucket\Api\Repositories\Workspaces\Issues;

use Bitbucket\Api\Repositories\Workspaces\AbstractWorkspacesApi;
use Bitbucket\Client;

/**
 * The abstract issues API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
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
     * @param Client $client
     * @param string $workspace
     * @param string $repo
     * @param string $issue
     *
     * @return void
     */
    public function __construct(Client $client, string $workspace, string $repo, string $issue)
    {
        parent::__construct($client, $workspace, $repo);
        $this->issue = $issue;
    }
}
