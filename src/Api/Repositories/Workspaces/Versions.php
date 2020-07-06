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

namespace Bitbucket\Api\Repositories\Workspaces;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The versions api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Versions extends AbstractWorkspacesApi
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
        $uri = $this->buildVersionsUri();

        return $this->get($uri, $params);
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
        $uri = $this->buildVersionsUri($version);

        return $this->get($uri, $params);
    }

    /**
     * Build the versions URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildVersionsUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'versions', ...$parts);
    }
}
