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

namespace Bitbucket\Api\Teams;

/**
 * The hooks api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Hooks extends AbstractTeamsApi
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
        $path = $this->buildHooksPath();

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
        $path = $this->buildHooksPath();

        return $this->post($path, $params);
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
        $path = $this->buildHooksPath($hook);

        return $this->get($path, $params);
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
        $path = $this->buildHooksPath($hook);

        return $this->put($path, $params);
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
        $path = $this->buildHooksPath($hook);

        return $this->delete($path, $params);
    }

    /**
     * Build the hooks path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildHooksPath(string ...$parts)
    {
        return static::buildPath('teams', $this->username, 'hooks', ...$parts);
    }
}
