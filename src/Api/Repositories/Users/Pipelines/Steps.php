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

namespace Bitbucket\Api\Repositories\Users\Pipelines;

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
        $path = $this->buildStepsPath();

        return $this->get($path, $params);
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
        $path = $this->buildStepsPath($step);

        return $this->get($path, $params);
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
        $path = $this->buildStepsPath($step, 'log');

        return $this->pureGet($path, $params, ['Accept' => 'application/octet-stream'])->getBody();
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
        $path = $this->buildStepsPath($step, 'stopPipeline');

        return $this->post($path, $params);
    }

    /**
     * Build the steps path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildStepsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'pipelines', $this->pipeline, 'steps', ...$parts);
    }
}
