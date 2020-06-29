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

/**
 * The diff stat api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class DiffStat extends AbstractPullRequestsApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function download(array $params = [])
    {
        $path = $this->buildDiffStatPath();

        return $this->get($path, $params);
    }

    /**
     * Build the diff stat path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildDiffStatPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'pullrequests', $this->pr, 'diffstat', ...$parts);
    }
}
