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

namespace Bitbucket\Api\Snippets\Users;

/**
 * The comments api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Comments extends AbstractUsersApi
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
        $path = $this->buildCommentsPath();

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
        $path = $this->buildCommentsPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $comment
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $comment, array $params = [])
    {
        $path = $this->buildCommentsPath($comment);

        return $this->get($path, $params);
    }

    /**
     * @param string $comment
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $comment, array $params = [])
    {
        $path = $this->buildCommentsPath($comment);

        return $this->put($path, $params);
    }

    /**
     * @param string $comment
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $comment, array $params = [])
    {
        $path = $this->buildCommentsPath($comment);

        return $this->delete($path, $params);
    }

    /**
     * Build the comments path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildCommentsPath(string ...$parts)
    {
        return static::buildPath('snippets', $this->username, $this->snippet, 'comments', ...$parts);
    }
}
