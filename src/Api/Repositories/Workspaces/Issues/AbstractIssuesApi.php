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
use Http\Client\Common\HttpMethodsClientInterface;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The abstract issues api class.
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
     * Create a new api instance.
     *
     * @param \Http\Client\Common\HttpMethodsClientInterface $client
     * @param string                                         $workspace
     * @param string                                         $repo
     * @param string                                         $issue
     */
    public function __construct(HttpMethodsClientInterface $client, string $workspace, string $repo, string $issue)
    {
        parent::__construct($client, $workspace, $repo);
        $this->issue = $issue;
    }
}
