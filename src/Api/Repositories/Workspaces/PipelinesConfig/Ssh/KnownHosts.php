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

namespace Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Ssh;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The known hosts API class.
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
        $uri = UriBuilder::appendSeparator($this->buildKnownHostsUri());

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
        $uri = UriBuilder::appendSeparator($this->buildKnownHostsUri());

        return $this->post($uri, $params);
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
        $uri = $this->buildKnownHostsUri($host);

        return $this->get($uri, $params);
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
        $uri = $this->buildKnownHostsUri($host);

        return $this->put($uri, $params);
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
        $uri = $this->buildKnownHostsUri($host);

        return $this->delete($uri, $params);
    }

    /**
     * Build the known hosts URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildKnownHostsUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines_config', 'ssh', 'known_hosts', ...$parts);
    }
}
