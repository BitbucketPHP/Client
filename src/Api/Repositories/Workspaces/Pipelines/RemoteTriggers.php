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

namespace Bitbucket\Api\Repositories\Workspaces\Pipelines;

/**
 * The remote triggers api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class RemoteTriggers extends AbstractPipelinesApi
{
    /**
     * @param string $key
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $key, array $params = [])
    {
        $path = $this->buildRemoteTriggersPath($key);

        return $this->put($path, $params);
    }

    /**
     * Build the remote triggers path from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildRemoteTriggersPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'pipelines', $this->pipeline, 'remote-triggers', ...$parts);
    }
}
