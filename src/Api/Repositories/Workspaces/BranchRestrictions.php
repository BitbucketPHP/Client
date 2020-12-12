<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The branch restrictions API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class BranchRestrictions extends AbstractWorkspacesApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = [])
    {
        $uri = $this->buildBranchRestrictionsUri();

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $uri = $this->buildBranchRestrictionsUri();

        return $this->post($uri, $params);
    }

    /**
     * @param string $restriction
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $restriction, array $params = [])
    {
        $uri = $this->buildBranchRestrictionsUri($restriction);

        return $this->get($uri, $params);
    }

    /**
     * @param string $restriction
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $restriction, array $params = [])
    {
        $uri = $this->buildBranchRestrictionsUri($restriction);

        return $this->put($uri, $params);
    }

    /**
     * @param string $restriction
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $restriction, array $params = [])
    {
        $uri = $this->buildBranchRestrictionsUri($restriction);

        return $this->delete($uri, $params);
    }

    /**
     * Build the branch restrictions URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildBranchRestrictionsUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'branch-restrictions', ...$parts);
    }
}
