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
        $path = $this->buildPullRequestsPath($username);

        return $this->get($path, $params);
    }

    /**
     * Build the pull requests path from the given parts.
     *
     * @param string ...$parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildPullRequestsPath(string ...$parts)
    {
        return static::buildPath('pullrequests', ...$parts);
    }
}
