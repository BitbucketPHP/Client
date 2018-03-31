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
 * The hook events api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class HookEvents extends AbstractApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listUserEvents(array $params = [])
    {
        $path = $this->buildHookEventsPath('user');

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listRepositoryEvents(array $params = [])
    {
        $path = $this->buildHookEventsPath('repository');

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listTeamEvents(array $params = [])
    {
        $path = $this->buildHookEventsPath('team');

        return $this->get($path, $params);
    }

    /**
     * Build the hook events path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildHookEventsPath(string ...$parts)
    {
        return static::buildPath('hook_events', ...$parts);
    }
}
