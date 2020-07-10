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

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The approval api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Approval extends AbstractPullRequestsApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function approve(array $params = [])
    {
        $uri = $this->buildApprovalUri();

        return $this->post($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function redact(array $params = [])
    {
        $uri = $this->buildApprovalUri();

        return $this->delete($uri, $params);
    }

    /**
     * Build the approval URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildApprovalUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pullrequests', $this->pr, 'approve', ...$parts);
    }
}
