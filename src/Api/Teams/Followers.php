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

namespace Bitbucket\Api\Teams;

/**
 * The followers api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Followers extends AbstractTeamsApi
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
        $path = $this->buildFollowersPath();

        return $this->get($path, $params);
    }

    /**
     * Build the followers path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildFollowersPath(string ...$parts)
    {
        return static::buildPath('teams', $this->username, 'followers', ...$parts);
    }
}
