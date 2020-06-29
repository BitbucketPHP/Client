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

namespace Bitbucket\Api;

class Workspaces extends AbstractApi
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
        $path = $this->buildWorkspacePath();

        return $this->get($path, $params);
    }

    public function all()
    {
        $workspaces = [];
        $page = 1;

        do {
            $workspace = $this->list(['page' => $page]);
            $workspaces = array_merge($workspaces, $workspace['values']);
            $page++;
        } while (isset($workspace['next']));

        return $workspaces;
    }

    /**
     * @param string $workspace
     * @param array $params
     *
     * @return array
     *
     * @throws \Http\Client\Exception
     */
    public function show(string $workspace, array $params = [])
    {
        $path = $this->buildWorkspacePath($workspace);

        return $this->get($path, $params);
    }

    /**
     * Build the workspaces path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildWorkspacePath(string ...$parts)
    {
        return static::buildPath('workspaces', ...$parts);
    }
}