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
        $uri = $this->buildDiffUri();

        return $this->pureGet($uri, $params, ['Accept' => 'text/plain'])->getBody();
    }

    /**
     * Build the diff URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildDiffUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'pullrequests', $this->pr, 'diff', ...$parts);
    }
}
