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

use Bitbucket\HttpClient\Util\UriBuilder;

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
        $uri = $this->buildPermissionsUri();

        return $this->get($uri, $params);
    }

    /**
     * Build the permissions URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildPermissionsUri(string ...$parts)
    {
        return UriBuilder::build('workspaces', $this->workspace, 'permissions', ...$parts);
    }
}
