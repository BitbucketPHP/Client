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

namespace Bitbucket\Api\Repositories\Users\Issues;

use Bitbucket\Api\Repositories\Users\AbstractUsersApi;
use Http\Client\Common\HttpMethodsClient;

/**
 * The abstract issues api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractIssuesApi extends AbstractUsersApi
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
     * @param \Http\Client\Common\HttpMethodsClient $client
     * @param string                                $username
     * @param string                                $repo
     * @param string                                $issue
     */
    public function __construct(HttpMethodsClient $client, string $username, string $repo, string $issue)
    {
        parent::__construct($client, $username, $repo);
        $this->issue = $issue;
    }
}
