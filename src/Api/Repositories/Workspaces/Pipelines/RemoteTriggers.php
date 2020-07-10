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

use Bitbucket\HttpClient\Util\UriBuilder;

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
        $uri = $this->buildRemoteTriggersUri($key);

        return $this->put($uri, $params);
    }

    /**
     * Build the remote triggers URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildRemoteTriggersUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines', $this->pipeline, 'remote-triggers', ...$parts);
    }
}
