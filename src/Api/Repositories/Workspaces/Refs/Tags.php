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

namespace Bitbucket\Api\Repositories\Workspaces\Refs;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The tags api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Tags extends AbstractRefsApi
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
        $uri = $this->buildTagsUri();

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $uri = $this->buildTagsUri();

        return $this->post($uri, $params);
    }

    /**
     * @param string $tag
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $tag, array $params = [])
    {
        $uri = $this->buildTagsUri($tag);

        return $this->get($uri, $params);
    }

    /**
     * @param string $tag
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $tag, array $params = [])
    {
        $uri = $this->buildTagsUri($tag);

        return $this->delete($uri, $params);
    }

    /**
     * Build the tags URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildTagsUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'refs', 'tags', ...$parts);
    }
}
