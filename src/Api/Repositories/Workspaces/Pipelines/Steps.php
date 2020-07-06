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
 * The steps api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Steps extends AbstractPipelinesApi
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
        $uri = UriBuilder::appendSeparator($this->buildStepsUri());

        return $this->get($uri, $params);
    }

    /**
     * @param string $step
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $step, array $params = [])
    {
        $uri = $this->buildStepsUri($step);

        return $this->get($uri, $params);
    }

    /**
     * @param string $step
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function log(string $step, array $params = [])
    {
        $uri = $this->buildStepsUri($step, 'log');

        return $this->pureGet($uri, $params, ['Accept' => 'application/octet-stream'])->getBody();
    }

    /**
     * @param string $step
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function stop(string $step, array $params = [])
    {
        $uri = $this->buildStepsUri($step, 'stopPipeline');

        return $this->post($uri, $params);
    }

    /**
     * Build the steps URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildStepsUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'pipelines', $this->pipeline, 'steps', ...$parts);
    }
}
