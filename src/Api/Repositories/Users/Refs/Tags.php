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

namespace Bitbucket\Api\Repositories\Users\Refs;

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
        $path = $this->buildTagsPath();

        return $this->get($path, $params);
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
        $path = $this->buildTagsPath();

        return $this->post($path, $params);
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
        $path = $this->buildTagsPath($tag);

        return $this->get($path, $params);
    }

    /**
     * Build the tags path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildTagsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'refs', 'tags', ...$parts);
    }
}
