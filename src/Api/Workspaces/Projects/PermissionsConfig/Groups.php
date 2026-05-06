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

namespace Bitbucket\Api\Workspaces\Projects\PermissionsConfig;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The groups API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Groups extends AbstractPermissionsConfigApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildGroupsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $group, array $params = []): array
    {
        $uri = $this->buildGroupsUri($group);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $group, array $params = []): array
    {
        $uri = $this->buildGroupsUri($group);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $group, array $params = []): array
    {
        $uri = $this->buildGroupsUri($group);

        return $this->delete($uri, $params);
    }

    /**
     * Build the groups URI from the given parts.
     */
    protected function buildGroupsUri(string ...$parts): string
    {
        return UriBuilder::build('workspaces', $this->workspace, 'projects', $this->project, 'permissions-config', 'groups', ...$parts);
    }
}
