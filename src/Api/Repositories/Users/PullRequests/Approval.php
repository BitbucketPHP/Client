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

namespace Bitbucket\Api\Repositories\Users\PullRequests;

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
        $path = $this->buildApprovalPath();

        return $this->post($path, $params);
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
        $path = $this->buildApprovalPath();

        return $this->delete($path, $params);
    }

    /**
     * Build the approval path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildApprovalPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'pullrequests', $this->pr, 'approve', ...$parts);
    }
}
