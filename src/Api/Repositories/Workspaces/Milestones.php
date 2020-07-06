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
 * The milestones api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Milestones extends AbstractWorkspacesApi
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
        $uri = $this->buildMilestonesUri();

        return $this->get($uri, $params);
    }

    /**
     * @param string $milestone
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $milestone, array $params = [])
    {
        $uri = $this->buildMilestonesUri($milestone);

        return $this->get($uri, $params);
    }

    /**
     * Build the milestones URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildMilestonesUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'milestones', ...$parts);
    }
}
