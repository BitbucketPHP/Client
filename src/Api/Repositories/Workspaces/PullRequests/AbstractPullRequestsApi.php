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

namespace Bitbucket\Api\Repositories\Workspaces\PullRequests;

use Bitbucket\Api\Repositories\Workspaces\AbstractWorkspacesApi;
use Http\Client\Common\HttpMethodsClientInterface;

/**
 * The abstract pull requests api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractPullRequestsApi extends AbstractWorkspacesApi
{
    /**
     * The pr.
     *
     * @var string
     */
    protected $pr;

    /**
     * Create a new api instance.
     *
     * @param \Http\Client\Common\HttpMethodsClientInterface $client
     * @param string                                         $workspace
     * @param string                                         $repo
     * @param string                                         $pr
     */
    public function __construct(HttpMethodsClientInterface $client, string $workspace, string $repo, string $pr)
    {
        parent::__construct($client, $workspace, $repo);
        $this->pr = $pr;
    }
}
