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

use Bitbucket\HttpClient\Util\UriBuilder;

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
        $uri = $this->buildHookEventsUri('user');

        return $this->get($uri, $params);
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
        $uri = $this->buildHookEventsUri('repository');

        return $this->get($uri, $params);
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
        $uri = $this->buildHookEventsUri('team');

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listWorkspaceEvents(array $params = [])
    {
        $uri = $this->buildHookEventsUri('workspace');

        return $this->get($uri, $params);
    }

    /**
     * Build the hook events URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildHookEventsUri(string ...$parts)
    {
        return UriBuilder::build('hook_events', ...$parts);
    }
}
