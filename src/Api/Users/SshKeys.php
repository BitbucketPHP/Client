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

use Bitbucket\HttpClient\Util\UriBuilder;

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
        $uri = UriBuilder::appendSeparator($this->buildSshKeysUri());

        return $this->get($uri, $params);
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
        $uri = UriBuilder::appendSeparator($this->buildSshKeysUri());

        return $this->post($uri, $params);
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
        $uri = $this->buildSshKeysUri($id);

        return $this->get($uri, $params);
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
        $uri = $this->buildSshKeysUri($id);

        return $this->put($uri, $params);
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
        $uri = $this->buildSshKeysUri($id);

        return $this->delete($uri, $params);
    }

    /**
     * Build the ssh keys URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildSshKeysUri(string ...$parts)
    {
        return UriBuilder::buildUri('users', $this->username, 'ssh-keys', ...$parts);
    }
}
