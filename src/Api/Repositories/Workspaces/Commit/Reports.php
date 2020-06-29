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

namespace Bitbucket\Api\Repositories\Workspaces\Commit;

use Bitbucket\Api\Repositories\Workspaces\Commit\Reports\Annotations;

/**
 * The reports api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Reports extends AbstractCommitApi
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
        $path = $this->buildReportsPath();

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
        $path = $this->buildReportsPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $report
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $report, array $params = [])
    {
        $path = $this->buildReportsPath($report);

        return $this->get($path, $params);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Commit\Reports\Annotations
     */
    public function annotations()
    {
        return new Annotations($this->getHttpClient(), $this->workspace, $this->repo, $this->commit);
    }

    /**
     * Build the reports path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildReportsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'reports', ...$parts);
    }
}
