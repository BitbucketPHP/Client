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

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The branch restrictions API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
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
        $uri = UriBuilder::build('repositories', $this->workspace, $this->repo, 'commits');

        return $this->get($uri, $params);
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
        $uri = UriBuilder::build('repositories', $this->workspace, $this->repo, 'commit', $commit);

        return $this->get($uri, $params);
    }
}
