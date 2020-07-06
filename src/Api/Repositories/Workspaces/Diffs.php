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
 * The diffs api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Diffs extends AbstractWorkspacesApi
{
    /**
     * @param string $spec
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function download(string $spec, array $params = [])
    {
        $uri = $this->buildDiffsUri($spec);

        return $this->pureGet($uri, $params, ['Accept' => 'text/plain'])->getBody();
    }

    /**
     * Build the diff URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildDiffsUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'diff', ...$parts);
    }
}
