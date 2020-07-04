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
        $path = $this->buildDeployKeysPath();

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
        $path = $this->buildDeployKeysPath();

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
        $path = $this->buildDeployKeysPath($id);

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
        $path = $this->buildDeployKeysPath($id);

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
        $path = $this->buildDeployKeysPath($id);

        return $this->delete($path, $params);
    }

    /**
     * Build the deploy keys path from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildDeployKeysPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'deploy-keys', ...$parts);
    }
}
