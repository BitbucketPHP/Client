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

namespace Bitbucket\Api\Repositories\Workspaces\Commit;

/**
 * The pull requests api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class PullRequests extends AbstractCommitApi
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
        $path = $this->buildPullRequestsPath();

        return $this->get($path, $params);
    }

    /**
     * Build the pull requests path from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildPullRequestsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'pullrequests', ...$parts);
    }
}
