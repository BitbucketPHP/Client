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

use Bitbucket\Api\Repositories\Users\Commit\Approval;
use Bitbucket\Api\Repositories\Users\Commit\Comments;
use Bitbucket\Api\Repositories\Users\Commit\Statuses;

/**
 * The commit api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Commit extends AbstractUsersApi
{
    /**
     * @param string $commit
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $commit, array $params = [])
    {
        $path = $this->buildCommitPath($commit);

        return $this->get($path, $params);
    }

    /**
     * @param string $commit
     *
     * @return \Bitbucket\Api\Repositories\Users\Commit\Approval
     */
    public function approval(string $commit)
    {
        return new Approval($this->getHttpClient(), $this->username, $this->repo, $commit);
    }

    /**
     * @param string $commit
     *
     * @return \Bitbucket\Api\Repositories\Users\Commit\Comments
     */
    public function comments(string $commit)
    {
        return new Comments($this->getHttpClient(), $this->username, $this->repo, $commit);
    }

    /**
     * @param string $commit
     *
     * @return \Bitbucket\Api\Repositories\Users\Commit\Statuses
     */
    public function statuses(string $commit)
    {
        return new Statuses($this->getHttpClient(), $this->username, $this->repo, $commit);
    }

    /**
     * Build the commit path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildCommitPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'commit', ...$parts);
    }
}
