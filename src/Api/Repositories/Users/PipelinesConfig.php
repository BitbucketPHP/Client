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
 * The pipelines config api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class PipelinesConfig extends AbstractUsersApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(array $params = [])
    {
        $path = $this->buildPipelinesConfigPath();

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(array $params = [])
    {
        $path = $this->buildPipelinesConfigPath();

        return $this->put($path, $params);
    }

    /**
     * Build the pipelines config path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildPipelinesConfigPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'pipelines_config', ...$parts);
    }
}
