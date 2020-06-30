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

namespace Bitbucket\Api\Workspaces;

/**
 * The permissions api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Permissions extends AbstractWorkspacesApi
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
        $path = $this->buildPermissionsPath();

        return $this->get($path, $params);
    }

    /**
     * Build the permissions path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildPermissionsPath(string ...$parts)
    {
        return static::buildPath('workspaces', $this->workspace, 'permissions', ...$parts);
    }
}
