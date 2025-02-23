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

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The environments API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Environments extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildEnvironmentsUri());

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $env, array $params = []): array
    {
        $uri = $this->buildEnvironmentsUri($env);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildEnvironmentsUri());

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $env, array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildEnvironmentsUri($env, 'changes'));

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $env): array
    {
        $uri = $this->buildEnvironmentsUri($env);

        return $this->delete($uri);
    }

    /**
     * Build the environments URI from the given parts.
     */
    protected function buildEnvironmentsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'environments', ...$parts);
    }
}
