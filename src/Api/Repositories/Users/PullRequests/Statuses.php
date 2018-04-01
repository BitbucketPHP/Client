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
 * The statuses api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Statuses extends AbstractPullRequestsApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = [])
    {
        $path = $this->buildStatusesPath();

        return $this->get($path, $params);
    }

    /**
     * Build the statuses path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildStatusesPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'pullrequests', $this->pr, 'statuses', ...$parts);
    }
}
