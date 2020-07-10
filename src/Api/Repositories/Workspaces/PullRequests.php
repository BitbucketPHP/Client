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
use Bitbucket\HttpClient\Util\UriBuilder;

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
        $uri = $this->buildPullRequestsUri();

        return $this->get($uri, $params);
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
        $uri = $this->buildPullRequestsUri('activity');

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
        $uri = $this->buildPullRequestsUri();

        return $this->post($uri, $params);
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
        $uri = $this->buildPullRequestsUri($pr);

        return $this->get($uri, $params);
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
        $uri = $this->buildPullRequestsUri($pr, 'activity');

        return $this->get($uri, $params);
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
        $uri = $this->buildPullRequestsUri($pr);

        return $this->put($uri, $params);
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
        $uri = $this->buildPullRequestsUri($pr, 'decline');

        return $this->post($uri, $params);
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
        $uri = $this->buildPullRequestsUri($pr, 'merge');

        return $this->post($uri, $params);
    }

    /**
     * @param string $pr
     * @param string $task
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function mergeTaskStatus(string $pr, string $task, array $params = [])
    {
        $uri = $this->buildPullRequestsUri($pr, 'merge', 'task-status', $task);

        return $this->get($uri, $params);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Approval
     */
    public function approval(string $pr)
    {
        return new Approval($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Comments
     */
    public function comments(string $pr)
    {
        return new Comments($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Commits
     */
    public function commits(string $pr)
    {
        return new PullRequestsCommits($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Diff
     */
    public function diff(string $pr)
    {
        return new Diff($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\DiffStat
     */
    public function diffstat(string $pr)
    {
        return new DiffStat($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Patch
     */
    public function patch(string $pr)
    {
        return new Patch($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Properties
     */
    public function properties(string $pr)
    {
        return new PullRequestsProperties($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Statuses
     */
    public function statuses(string $pr)
    {
        return new Statuses($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * Build the pull requests URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildPullRequestsUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pullrequests', ...$parts);
    }
}
