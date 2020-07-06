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

namespace Bitbucket\Api;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The pull requests api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class PullRequests extends AbstractApi
{
    /**
     * @param string $username
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(string $username, array $params = [])
    {
        $uri = $this->buildPullRequestsUri($username);

        return $this->get($uri, $params);
    }

    /**
     * Build the pull requests URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildPullRequestsUri(string ...$parts)
    {
        return UriBuilder::buildUri('pullrequests', ...$parts);
    }
}
