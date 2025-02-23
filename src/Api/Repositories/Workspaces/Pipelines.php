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

use Bitbucket\Api\Repositories\Workspaces\Pipelines\RemoteTriggers;
use Bitbucket\Api\Repositories\Workspaces\Pipelines\Steps;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The pipelines API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Pipelines extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildPipelinesUri());

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildPipelinesUri());

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $pipeline, array $params = []): array
    {
        $uri = $this->buildPipelinesUri($pipeline);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function stop(string $pipeline, array $params = []): array
    {
        $uri = $this->buildPipelinesUri($pipeline, 'stopPipeline');

        return $this->post($uri, $params);
    }

    public function remoteTriggers(string $pipeline): RemoteTriggers
    {
        return new RemoteTriggers($this->getClient(), $this->workspace, $this->repo, $pipeline);
    }

    public function steps(string $pipeline): Steps
    {
        return new Steps($this->getClient(), $this->workspace, $this->repo, $pipeline);
    }

    /**
     * Build the pipelines URI from the given parts.
     */
    protected function buildPipelinesUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines', ...$parts);
    }
}
