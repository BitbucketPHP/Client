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

namespace Bitbucket\Api\CurrentUser;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The workspaces API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Workspaces extends AbstractCurrentUserApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildWorkspacesUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function showPermission(string $workspace, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($workspace, 'permission');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function listRepositoryPermissions(string $workspace, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($workspace, 'permissions', 'repositories');

        return $this->get($uri, $params);
    }

    /**
     * Build the workspaces URI from the given parts.
     */
    protected function buildWorkspacesUri(string ...$parts): string
    {
        return UriBuilder::build('user', 'workspaces', ...$parts);
    }
}
