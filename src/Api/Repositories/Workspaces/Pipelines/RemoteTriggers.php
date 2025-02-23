<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api\Repositories\Workspaces\Pipelines;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The remote triggers API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class RemoteTriggers extends AbstractPipelinesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $key, array $params = []): array
    {
        $uri = $this->buildRemoteTriggersUri($key);

        return $this->put($uri, $params);
    }

    /**
     * Build the remote triggers URI from the given parts.
     */
    protected function buildRemoteTriggersUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines', $this->pipeline, 'remote-triggers', ...$parts);
    }
}
