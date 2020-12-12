<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api\Repositories\Workspaces\Commit;

use Bitbucket\Api\Repositories\Workspaces\Commit\Reports\Annotations;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The reports API class.
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
        $uri = $this->buildReportsUri();

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
        $uri = $this->buildReportsUri();

        return $this->post($uri, $params);
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
        $uri = $this->buildReportsUri($report);

        return $this->get($uri, $params);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Commit\Reports\Annotations
     */
    public function annotations()
    {
        return new Annotations($this->getClient(), $this->workspace, $this->repo, $this->commit);
    }

    /**
     * Build the reports URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildReportsUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'reports', ...$parts);
    }
}
