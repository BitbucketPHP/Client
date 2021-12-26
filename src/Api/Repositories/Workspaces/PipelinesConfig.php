<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
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
 * @author Graham Campbell <graham@alt-three.com>
 */
class PipelinesConfig extends AbstractWorkspacesApi
{
    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Variables
     */
    public function variables()
    {
        return new Variables($this->getClient(), $this->workspace, $this->repo);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(array $params = [])
    {
        $uri = $this->buildPipelinesConfigUri();

        return $this->get($uri, $params);
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
        $uri = $this->buildPipelinesConfigUri();

        return $this->put($uri, $params);
    }

    /**
     * Build the pipelines config URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildPipelinesConfigUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines_config', ...$parts);
    }
}
