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

use Bitbucket\Api\Repositories\Workspaces\Refs\Branches;
use Bitbucket\Api\Repositories\Workspaces\Refs\Tags;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The refs API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Refs extends AbstractWorkspacesApi
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
        $uri = $this->buildRefsUri();

        return $this->get($uri, $params);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Refs\Branches
     */
    public function branches()
    {
        return new Branches($this->getClient(), $this->workspace, $this->repo, $this->getPerPage());
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Refs\Tags
     */
    public function tags()
    {
        return new Tags($this->getClient(), $this->workspace, $this->repo, $this->getPerPage());
    }

    /**
     * Build the refs URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildRefsUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'refs', ...$parts);
    }
}
