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

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\Api\Repositories\Workspaces\PullRequests\Approval;
use Bitbucket\Api\Repositories\Workspaces\PullRequests\Comments;
use Bitbucket\Api\Repositories\Workspaces\PullRequests\Commits as PullRequestsCommits;
use Bitbucket\Api\Repositories\Workspaces\PullRequests\Diff;
use Bitbucket\Api\Repositories\Workspaces\PullRequests\DiffStat;
use Bitbucket\Api\Repositories\Workspaces\PullRequests\Patch;
use Bitbucket\Api\Repositories\Workspaces\PullRequests\Properties as PullRequestsProperties;
use Bitbucket\Api\Repositories\Workspaces\PullRequests\Statuses;

/**
 * The pull requests api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class PullRequests extends AbstractWorkspacesApi
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
        $path = $this->buildPullRequestsPath();

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function activity(array $params = [])
    {
        $path = $this->buildPullRequestsPath('activity');

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
        $path = $this->buildPullRequestsPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $pr
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $pr, array $params = [])
    {
        $path = $this->buildPullRequestsPath($pr);

        return $this->get($path, $params);
    }

    /**
     * @param string $pr
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function activityByPr(string $pr, array $params = [])
    {
        $path = $this->buildPullRequestsPath($pr, 'activity');

        return $this->get($path, $params);
    }

    /**
     * @param string $pr
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $pr, array $params = [])
    {
        $path = $this->buildPullRequestsPath($pr);

        return $this->put($path, $params);
    }

    /**
     * @param string $pr
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function decline(string $pr, array $params = [])
    {
        $path = $this->buildPullRequestsPath($pr, 'decline');

        return $this->post($path, $params);
    }

    /**
     * @param string $pr
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function merge(string $pr, array $params = [])
    {
        $path = $this->buildPullRequestsPath($pr, 'merge');

        return $this->post($path, $params);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Approval
     */
    public function approval(string $pr)
    {
        return new Approval($this->getHttpClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Comments
     */
    public function comments(string $pr)
    {
        return new Comments($this->getHttpClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Commits
     */
    public function commits(string $pr)
    {
        return new PullRequestsCommits($this->getHttpClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Diff
     */
    public function diff(string $pr)
    {
        return new Diff($this->getHttpClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\DiffStat
     */
    public function diffstat(string $pr)
    {
        return new DiffStat($this->getHttpClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Patch
     */
    public function patch(string $pr)
    {
        return new Patch($this->getHttpClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Properties
     */
    public function properties(string $pr)
    {
        return new PullRequestsProperties($this->getHttpClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Statuses
     */
    public function statuses(string $pr)
    {
        return new Statuses($this->getHttpClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * Build the pull requests path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildPullRequestsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'pullrequests', ...$parts);
    }
}
