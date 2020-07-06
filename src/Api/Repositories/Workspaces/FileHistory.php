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
 * The file history api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class FileHistory extends AbstractWorkspacesApi
{
    /**
     * @param string $commit
     * @param string $uri
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(string $commit, string $uri, array $params = [])
    {
        $uri = $this->buildFileHistoryUri($commit, ...explode('/', $uri));

        return $this->get($uri, $params);
    }

    /**
     * Build the file history URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildFileHistoryUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'filehistory', ...$parts);
    }
}
