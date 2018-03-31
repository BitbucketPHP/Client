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

namespace Bitbucket\Api;

/**
 * The current user api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
        $path = $this->buildCurrentUserPath();

        return $this->get($path, $params);
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
        $path = $this->buildCurrentUserPath('emails');

        return $this->get($path, $params);
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
        $path = $this->buildCurrentUserPath('emails', $email);

        return $this->get($path, $params);
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
        $path = $this->buildCurrentUserPath('permissions', 'repositories');

        return $this->get($path, $params);
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
        $path = $this->buildCurrentUserPath('permissions', 'teams');

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listTeams(array $params = [])
    {
        $path = static::buildPath('teams');

        return $this->get($path, $params);
    }

    /**
     * Build the current user path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildCurrentUserPath(string ...$parts)
    {
        return static::buildPath('user', ...$parts);
    }
}
