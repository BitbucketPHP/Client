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

namespace Bitbucket\Api\Users;

/**
 * The ssh keys api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class SshKeys extends AbstractUsersApi
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
        $path = $this->buildSshKeysPath().static::URI_SEPARATOR;

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $path = $this->buildSshKeysPath().static::URI_SEPARATOR;

        return $this->post($path, $params);
    }

    /**
     * @param string $id
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $id, array $params = [])
    {
        $path = $this->buildSshKeysPath($id);

        return $this->get($path, $params);
    }

    /**
     * @param string $id
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $id, array $params = [])
    {
        $path = $this->buildSshKeysPath($id);

        return $this->put($path, $params);
    }

    /**
     * @param string $id
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $id, array $params = [])
    {
        $path = $this->buildSshKeysPath($id);

        return $this->delete($path, $params);
    }

    /**
     * Build the ssh keys path from the given parts.
     *
     * @param string ...$parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildSshKeysPath(string ...$parts)
    {
        return static::buildPath('users', $this->username, 'ssh-keys', ...$parts);
    }
}
