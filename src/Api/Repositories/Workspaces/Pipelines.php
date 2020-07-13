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

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\Api\Repositories\Workspaces\Pipelines\RemoteTriggers;
use Bitbucket\Api\Repositories\Workspaces\Pipelines\Steps;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The pipelines API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Pipelines extends AbstractWorkspacesApi
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
        $uri = UriBuilder::appendSeparator($this->buildPipelinesUri());

        return $this->get($uri, $params);
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
        $uri = UriBuilder::appendSeparator($this->buildPipelinesUri());

        return $this->post($uri, $params);
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
        $uri = $this->buildPipelinesUri($pipeline);

        return $this->get($uri, $params);
    }

    /**
     * @param string $pipeline
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function stop(string $pipeline, array $params = [])
    {
        $uri = $this->buildPipelinesUri($pipeline, 'stopPipeline');

        return $this->post($uri, $params);
    }

    /**
     * @param string $pipeline
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Pipelines\RemoteTriggers
     */
    public function remoteTriggers(string $pipeline)
    {
        return new RemoteTriggers($this->getClient(), $this->getPerPage(), $this->workspace, $this->repo, $pipeline);
    }

    /**
     * @param string $pipeline
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\Pipelines\Steps
     */
    public function steps(string $pipeline)
    {
        return new Steps($this->getClient(), $this->getPerPage(), $this->workspace, $this->repo, $pipeline);
    }

    /**
     * Build the pipelines URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildPipelinesUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines', ...$parts);
    }
}
