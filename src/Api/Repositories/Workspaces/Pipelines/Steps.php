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
 * The steps API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Steps extends AbstractPipelinesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildStepsUri());

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $step, array $params = []): array
    {
        $uri = $this->buildStepsUri($step);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function log(string $step, array $params = []): \Psr\Http\Message\StreamInterface
    {
        $uri = $this->buildStepsUri($step, 'log');

        return $this->getAsResponse($uri, $params, ['Accept' => 'application/octet-stream'])->getBody();
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function specificLog(string $step, string $uuid, array $params = []): \Psr\Http\Message\StreamInterface
    {
        $uri = $this->buildStepsUri($step, 'logs', $uuid);

        return $this->getAsResponse($uri, $params, ['Accept' => 'application/octet-stream'])->getBody();
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function stop(string $step, array $params = []): array
    {
        $uri = $this->buildStepsUri($step, 'stopPipeline');

        return $this->post($uri, $params);
    }

    /**
     * Build the steps URI from the given parts.
     */
    protected function buildStepsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines', $this->pipeline, 'steps', ...$parts);
    }
}
