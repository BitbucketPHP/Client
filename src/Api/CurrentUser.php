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

namespace Bitbucket\Api;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The current user API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class CurrentUser extends AbstractApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function show(array $params = []): array
    {
        $uri = $this->buildCurrentUserUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function listEmails(array $params = []): array
    {
        $uri = $this->buildCurrentUserUri('emails');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function showEmail(string $email, array $params = []): array
    {
        $uri = $this->buildCurrentUserUri('emails', $email);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function listRepositoryPermissions(array $params = []): array
    {
        $uri = $this->buildCurrentUserUri('permissions', 'repositories');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function listTeamPermissions(array $params = []): array
    {
        $uri = $this->buildCurrentUserUri('permissions', 'teams');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function listWorkspacePermissions(array $params = []): array
    {
        $uri = $this->buildCurrentUserUri('permissions', 'workspaces');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function listWorkspaces(array $params = []): array
    {
        $uri = UriBuilder::build('workspaces');

        return $this->get($uri, $params);
    }

    /**
     * Build the current user URI from the given parts.
     */
    protected function buildCurrentUserUri(string ...$parts): string
    {
        return UriBuilder::build('user', ...$parts);
    }
}
