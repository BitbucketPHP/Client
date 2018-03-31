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

namespace Bitbucket\Api\Repositories\Issues;

/**
 * The watch class.
 *
 * @author Graham Campbell <graham@alt-thre.com>
 */
class Watch extends AbstractIssuesApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function check(array $params = [])
    {
        $path = $this->buildWatchPath();

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function watch(array $params = [])
    {
        $path = $this->buildWatchPath();

        return $this->put($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function ignore(array $params = [])
    {
        $path = $this->buildWatchPath();

        return $this->delete($path, $params);
    }

    /**
     * Build the watch path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildWatchPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, 'issues', $this->issue, 'watch', ...$parts);
    }
}
