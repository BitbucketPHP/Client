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

namespace Bitbucket\Api\Repositories\Users\PipelinesConfig\Ssh;

/**
 * The key pair api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class KeyPair extends AbstractSshApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(array $params = [])
    {
        $path = $this->buildKeyPairPath();

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(array $params = [])
    {
        $path = $this->buildKeyPairPath();

        return $this->put($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(array $params = [])
    {
        $path = $this->buildKeyPairPath();

        return $this->delete($path, $params);
    }

    /**
     * Build the key pair path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildKeyPairPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'pipelines_config', 'ssh', 'key_pair', ...$parts);
    }
}
