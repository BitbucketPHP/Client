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
 * The merge bases api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MergeBases extends AbstractWorkspacesApi
{
    /**
     * @param string $spec
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $spec, array $params = [])
    {
        $uri = $this->buildMergeBasesUri($spec);

        return $this->get($uri, $params);
    }

    /**
     * Build the merge base URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildMergeBasesUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'merge-base', ...$parts);
    }
}
