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

namespace Bitbucket\Api\Repositories\Users;

/**
 * The properties api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Properties extends AbstractUsersApi
{
    /**
     * @param string $app
     * @param string $property
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $app, string $property, array $params = [])
    {
        $path = $this->buildPropertiesPath($app, $property);

        return $this->get($path, $params);
    }

    /**
     * @param string $app
     * @param string $property
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $app, string $property, array $params = [])
    {
        $path = $this->buildPropertiesPath($app, $property);

        return $this->put($path, $params);
    }

    /**
     * @param string $app
     * @param string $property
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $app, string $property, array $params = [])
    {
        $path = $this->buildPropertiesPath($app, $property);

        return $this->delete($path, $params);
    }

    /**
     * Build the properties path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildPropertiesPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'properties', ...$parts);
    }
}
