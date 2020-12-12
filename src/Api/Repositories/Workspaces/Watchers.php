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
 * The watchers API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Watchers extends AbstractWorkspacesApi
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
        $uri = $this->buildWatchersUri();

        return $this->get($uri, $params);
    }

    /**
     * Build the watchers URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildWatchersUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'watchers', ...$parts);
    }
}
