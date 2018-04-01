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
 * The diff api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Diff extends AbstractPullRequestsApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function download(array $params = [])
    {
        $path = $this->buildDiffPath();

        return $this->pureGet($path, $params, ['Accept' => 'text/plain'])->getBody();
    }

    /**
     * Build the diff path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildDiffPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'pullrequests', $this->pr, 'diff', ...$parts);
    }
}
