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

namespace Bitbucket\Api\Workspaces\Permissions;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The repositories API class.
 *
 * @author Patrick Barsallo <p.d.barsallo@gmail.com>
 */
class Repositories extends AbstractPermissionsApi
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
        $uri = UriBuilder::appendSeparator($this->buildRepositoriesUri());

        return $this->get($uri, $params);
    }

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
        $uri = $this->buildRepositoriesUri($repo);

        return $this->get($uri, $params);
    }

    /**
     * Build the repositories URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildRepositoriesUri(string ...$parts)
    {
        return UriBuilder::build('workspaces', $this->workspace, 'permissions', 'repositories', ...$parts);
    }
}
