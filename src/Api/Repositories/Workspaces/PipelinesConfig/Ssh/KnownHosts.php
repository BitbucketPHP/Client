<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Ssh;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The known hosts API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class KnownHosts extends AbstractSshApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildKnownHostsUri());

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildKnownHostsUri());

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $host, array $params = []): array
    {
        $uri = $this->buildKnownHostsUri($host);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $host, array $params = []): array
    {
        $uri = $this->buildKnownHostsUri($host);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $host, array $params = []): array
    {
        $uri = $this->buildKnownHostsUri($host);

        return $this->delete($uri, $params);
    }

    /**
     * Build the known hosts URI from the given parts.
     */
    protected function buildKnownHostsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines_config', 'ssh', 'known_hosts', ...$parts);
    }
}
