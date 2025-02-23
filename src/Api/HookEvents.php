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
 * The hook events API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class HookEvents extends AbstractApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function listUserEvents(array $params = []): array
    {
        $uri = $this->buildHookEventsUri('user');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function listRepositoryEvents(array $params = []): array
    {
        $uri = $this->buildHookEventsUri('repository');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function listTeamEvents(array $params = []): array
    {
        $uri = $this->buildHookEventsUri('team');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function listWorkspaceEvents(array $params = []): array
    {
        $uri = $this->buildHookEventsUri('workspace');

        return $this->get($uri, $params);
    }

    /**
     * Build the hook events URI from the given parts.
     */
    protected function buildHookEventsUri(string ...$parts): string
    {
        return UriBuilder::build('hook_events', ...$parts);
    }
}
