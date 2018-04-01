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
 * The versions api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Versions extends AbstractUsersApi
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
        $path = $this->buildVersionsPath();

        return $this->get($path, $params);
    }

    /**
     * @param string $version
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $version, array $params = [])
    {
        $path = $this->buildVersionsPath($version);

        return $this->get($path, $params);
    }

    /**
     * Build the versions path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildVersionsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'versions', ...$parts);
    }
}
