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
 * The branch restrictions api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Commits extends AbstractWorkspacesApi
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
        $uri = $this->buildCommitsUri();

        return $this->post($uri, $params);
    }

    /**
     * @param string $commit
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $commit, array $params = [])
    {
        $uri = $this->buildCommitsUri($commit);

        return $this->post($uri, $params);
    }

    /**
     * Build the commits URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildCommitsUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'commits', ...$parts);
    }
}
