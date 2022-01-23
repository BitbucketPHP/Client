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
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(array $params = [])
    {
        $uri = $this->buildCurrentUserUri();

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listEmails(array $params = [])
    {
        $uri = $this->buildCurrentUserUri('emails');

        return $this->get($uri, $params);
    }

    /**
     * @param string $email
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function showEmail(string $email, array $params = [])
    {
        $uri = $this->buildCurrentUserUri('emails', $email);

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listRepositoryPermissions(array $params = [])
    {
        $uri = $this->buildCurrentUserUri('permissions', 'repositories');

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listTeamPermissions(array $params = [])
    {
        $uri = $this->buildCurrentUserUri('permissions', 'teams');

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listWorkspacePermissions(array $params = [])
    {
        $uri = $this->buildCurrentUserUri('permissions', 'workspaces');

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listWorkspaces(array $params = [])
    {
        $uri = UriBuilder::build('workspaces');

        return $this->get($uri, $params);
    }

    /**
     * Build the current user URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildCurrentUserUri(string ...$parts)
    {
        return UriBuilder::build('user', ...$parts);
    }
}
