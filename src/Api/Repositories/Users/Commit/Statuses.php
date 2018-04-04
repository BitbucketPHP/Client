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

namespace Bitbucket\Api\Repositories\Users\Commit;

use Bitbucket\Api\Repositories\Users\Commit\Statuses\Build;

/**
 * The statuses api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Statuses extends AbstractCommitApi
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
        $path = $this->buildStatusesPath();

        return $this->get($path, $params);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Users\Commit\Statuses\Build
     */
    public function build()
    {
        return new Build($this->getHttpClient(), $this->username, $this->repo, $this->commit);
    }

    /**
     * Build the statuses path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildStatusesPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'commit', $this->commit, 'statuses', ...$parts);
    }
}
