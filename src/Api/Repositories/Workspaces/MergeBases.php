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
        $path = $this->buildMergeBasesPath($spec);

        return $this->get($path, $params);
    }

    /**
     * Build the merge base path from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildMergeBasesPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'merge-base', ...$parts);
    }
}
