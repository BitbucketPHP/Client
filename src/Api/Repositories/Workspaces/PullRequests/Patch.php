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
 * The patch api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Patch extends AbstractPullRequestsApi
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
        $uri = $this->buildPatchUri();

        return $this->pureGet($uri, $params, ['Accept' => 'text/plain'])->getBody();
    }

    /**
     * Build the patch URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildPatchUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'pullrequests', $this->pr, 'patch', ...$parts);
    }
}
