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
 * The deploy keys api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class DeployKeys extends AbstractWorkspacesApi
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
        $uri = $this->buildDeployKeysUri();

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
        $uri = $this->buildDeployKeysUri();

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
        $uri = $this->buildDeployKeysUri($id);

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
        $uri = $this->buildDeployKeysUri($id);

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
        $uri = $this->buildDeployKeysUri($id);

        return $this->delete($uri, $params);
    }

    /**
     * Build the deploy keys URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildDeployKeysUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'deploy-keys', ...$parts);
    }
}
