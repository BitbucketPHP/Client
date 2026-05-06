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

namespace Bitbucket\Api\Repositories\Workspaces\PermissionsConfig;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The users API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Users extends AbstractPermissionsConfigApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildUsersUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $selectedUserId, array $params = []): array
    {
        $uri = $this->buildUsersUri($selectedUserId);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $selectedUserId, array $params = []): array
    {
        $uri = $this->buildUsersUri($selectedUserId);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $selectedUserId, array $params = []): array
    {
        $uri = $this->buildUsersUri($selectedUserId);

        return $this->delete($uri, $params);
    }

    /**
     * Build the users URI from the given parts.
     */
    protected function buildUsersUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'permissions-config', 'users', ...$parts);
    }
}
