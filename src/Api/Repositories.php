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

use Bitbucket\Api\Repositories\Users as RepositoriesUsers;

/**
 * The repositories api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Repositories extends AbstractApi
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
        $path = $this->buildRepositoriesPath();

        return $this->get($path, $params);
    }

    /**
     * @param string $username
     * @param string $repo_name
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(string $username, string $repo_name, array $params = [])
    {
        $path = $this->buildRepositoriesPath($username, $repo_name);

        return $this->post($path, $params);
    }

    /**
     * @param string $username
     *
     * @return \Bitbucket\Api\Repositories\Users
     */
    public function users(string $username)
    {
        return new RepositoriesUsers($this->getHttpClient(), $username);
    }

    /**
     * Build the repositories path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildRepositoriesPath(string ...$parts)
    {
        return static::buildPath('repositories', ...$parts);
    }
}
