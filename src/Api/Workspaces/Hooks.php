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

namespace Bitbucket\Api\Workspaces;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The hooks API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Hooks extends AbstractWorkspacesApi
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
        $uri = $this->buildHooksUri();

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
        $uri = $this->buildHooksUri();

        return $this->post($uri, $params);
    }

    /**
     * @param string $hook
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $hook, array $params = [])
    {
        $uri = $this->buildHooksUri($hook);

        return $this->get($uri, $params);
    }

    /**
     * @param string $hook
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $hook, array $params = [])
    {
        $uri = $this->buildHooksUri($hook);

        return $this->put($uri, $params);
    }

    /**
     * @param string $hook
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $hook, array $params = [])
    {
        $uri = $this->buildHooksUri($hook);

        return $this->delete($uri, $params);
    }

    /**
     * Build the hooks URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildHooksUri(string ...$parts)
    {
        return UriBuilder::build('workspaces', $this->workspace, 'hooks', ...$parts);
    }
}
