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
 * The hooks API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Hooks extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildHooksUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildHooksUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $hook, array $params = []): array
    {
        $uri = $this->buildHooksUri($hook);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $hook, array $params = []): array
    {
        $uri = $this->buildHooksUri($hook);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $hook, array $params = []): array
    {
        $uri = $this->buildHooksUri($hook);

        return $this->delete($uri, $params);
    }

    /**
     * Build the hooks URI from the given parts.
     */
    protected function buildHooksUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'hooks', ...$parts);
    }
}
