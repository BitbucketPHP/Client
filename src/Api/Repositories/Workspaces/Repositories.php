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
 * The users api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Repositories extends AbstractWorkspacesApi
{
    /**
     * @param string $repo
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $repo, array $params = [])
    {
        $path = $this->buildRepositoryPath($repo);

        return $this->get($path, $params);
    }

    /**
     * Build the commit path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildRepositoryPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, ...$parts);
    }
}
