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

namespace Bitbucket\Api\Users\PipelinesConfig;

/**
 * The variables api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Variables extends AbstractPipelinesConfigApi
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
        $path = $this->buildVariablesPath();

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
        $path = $this->buildVariablesPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $variable
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $variable, array $params = [])
    {
        $path = $this->buildVariablesPath($variable);

        return $this->get($path, $params);
    }

    /**
     * @param string $variable
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $variable, array $params = [])
    {
        $path = $this->buildVariablesPath($variable);

        return $this->put($path, $params);
    }

    /**
     * @param string $variable
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $variable, array $params = [])
    {
        $path = $this->buildVariablesPath($variable);

        return $this->delete($path, $params);
    }

    /**
     * Build the variables path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildVariablesPath(string ...$parts)
    {
        return static::buildPath('users', $this->username, 'pipelines_config', 'variables', ...$parts);
    }
}
