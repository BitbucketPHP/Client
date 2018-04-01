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

use Bitbucket\Api\Repositories\Users\Pipelines\Steps;

/**
 * The pipelines api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Pipelines extends AbstractUsersApi
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
        $path = $this->buildPipelinesPath();

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
        $path = $this->buildPipelinesPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $pipeline
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $pipeline, array $params = [])
    {
        $path = $this->buildPipelinesPath($pipeline);

        return $this->get($path, $params);
    }

    /**
     * @param string $pipeline
     *
     * @return \Bitbucket\Api\Repositories\Users\Pipelines\Steps
     */
    public function steps(string $pipeline)
    {
        return new Steps($this->getHttpClient(), $this->username, $this->repo, $pipeline);
    }

    /**
     * Build the pipelines path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildPipelinesPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'pipelines', ...$parts);
    }
}
