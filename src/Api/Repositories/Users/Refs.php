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

namespace Bitbucket\Api\Repositories\Users;

use Bitbucket\Api\Repositories\Users\Refs\Branches;
use Bitbucket\Api\Repositories\Users\Refs\Tags;

/**
 * The refs api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Refs extends AbstractUsersApi
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
        $path = $this->buildRefsPath();

        return $this->get($path, $params);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Users\Refs\Branches
     */
    public function branches()
    {
        return new Branches($this->getHttpClient(), $this->username, $this->repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Users\Refs\Tags
     */
    public function tags()
    {
        return new Tags($this->getHttpClient(), $this->username, $this->repo);
    }

    /**
     * Build the refs path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildRefsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'refs', ...$parts);
    }
}
