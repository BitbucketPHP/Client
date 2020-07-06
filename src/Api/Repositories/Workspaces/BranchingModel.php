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

namespace Bitbucket\Api\Repositories\Workspaces;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The branching model api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class BranchingModel extends AbstractWorkspacesApi
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
        $uri = $this->buildBranchingModelUri();

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function showSettings(array $params = [])
    {
        $uri = $this->buildBranchingModelUri('settings');

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function updateSettings(array $params = [])
    {
        $uri = $this->buildBranchingModelUri('settings');

        return $this->put($uri, $params);
    }

    /**
     * Build the branching model URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildBranchingModelUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'branching-model', ...$parts);
    }
}
