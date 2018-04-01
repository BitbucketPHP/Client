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

namespace Bitbucket\Api\Repositories\Users\Issues;

/**
 * The changes api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Changes extends AbstractIssuesApi
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
        $path = $this->buildChangesPath();

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
        $path = $this->buildChangesPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $change
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $change, array $params = [])
    {
        $path = $this->buildChangesPath($change);

        return $this->get($path, $params);
    }

    /**
     * Build the changes path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildChangesPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'issues', $this->issue, 'changes', ...$parts);
    }
}
