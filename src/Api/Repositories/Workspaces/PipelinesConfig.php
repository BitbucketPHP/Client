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

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Variables;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The pipelines config API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class PipelinesConfig extends AbstractWorkspacesApi
{
    public function variables(): Variables
    {
        return new Variables($this->getClient(), $this->workspace, $this->repo);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(array $params = []): array
    {
        $uri = $this->buildPipelinesConfigUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(array $params = []): array
    {
        $uri = $this->buildPipelinesConfigUri();

        return $this->put($uri, $params);
    }

    /**
     * Build the pipelines config URI from the given parts.
     */
    protected function buildPipelinesConfigUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines_config', ...$parts);
    }
}
