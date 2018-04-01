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

namespace Bitbucket\Api\Repositories\Users;

/**
 * The watchers api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Watchers extends AbstractUsersApi
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
        $path = $this->buildWatchersPath();

        return $this->get($path, $params);
    }

    /**
     * Build the watchers path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildWatchersPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'watchers', ...$parts);
    }
}
