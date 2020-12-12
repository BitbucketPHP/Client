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

use Bitbucket\Api\Repositories\Workspaces as RepositoriesWorkspaces;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The repositories API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Repositories extends AbstractApi
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
        $uri = $this->buildRepositoriesUri();

        return $this->get($uri, $params);
    }

    /**
     * @param string $workspace
     *
     * @return \Bitbucket\Api\Repositories\Workspaces
     */
    public function workspaces(string $workspace)
    {
        return new RepositoriesWorkspaces($this->getClient(), $workspace);
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
        return UriBuilder::build('repositories', ...$parts);
    }
}
