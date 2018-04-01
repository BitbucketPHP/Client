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
 * The known hosts api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class KnownHosts extends AbstractSshApi
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
        $path = $this->buildKnownHostsPath();

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
        $path = $this->buildKnownHostsPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $host
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $host, array $params = [])
    {
        $path = $this->buildKnownHostsPath($host);

        return $this->get($path, $params);
    }

    /**
     * @param string $host
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $host, array $params = [])
    {
        $path = $this->buildKnownHostsPath($host);

        return $this->put($path, $params);
    }

    /**
     * @param string $host
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $host, array $params = [])
    {
        $path = $this->buildKnownHostsPath($host);

        return $this->delete($path, $params);
    }

    /**
     * Build the known hosts path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildKnownHostsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'pipelines_config', 'ssh', 'known_hosts', ...$parts);
    }
}
