<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
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
 * The pull requests API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class PullRequests extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildPullRequestsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function activity(array $params = []): array
    {
        $uri = $this->buildPullRequestsUri('activity');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildPullRequestsUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $pr, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function activityByPr(string $pr, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr, 'activity');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $pr, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function decline(string $pr, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr, 'decline');

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function merge(string $pr, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr, 'merge');

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function mergeTaskStatus(string $pr, string $task, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr, 'merge', 'task-status', $task);

        return $this->get($uri, $params);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Approval
     */
    public function approval(string $pr): \Bitbucket\Api\Repositories\Workspaces\PullRequests\Approval
    {
        return new Approval($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Comments
     */
    public function comments(string $pr): \Bitbucket\Api\Repositories\Workspaces\PullRequests\Comments
    {
        return new Comments($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Commits
     */
    public function commits(string $pr): \Bitbucket\Api\Repositories\Workspaces\PullRequests\Commits
    {
        return new PullRequestsCommits($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Diff
     */
    public function diff(string $pr): \Bitbucket\Api\Repositories\Workspaces\PullRequests\Diff
    {
        return new Diff($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\DiffStat
     */
    public function diffstat(string $pr): \Bitbucket\Api\Repositories\Workspaces\PullRequests\DiffStat
    {
        return new DiffStat($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Patch
     */
    public function patch(string $pr): \Bitbucket\Api\Repositories\Workspaces\PullRequests\Patch
    {
        return new Patch($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Properties
     */
    public function properties(string $pr): \Bitbucket\Api\Repositories\Workspaces\PullRequests\Properties
    {
        return new PullRequestsProperties($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PullRequests\Statuses
     */
    public function statuses(string $pr): \Bitbucket\Api\Repositories\Workspaces\PullRequests\Statuses
    {
        return new Statuses($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * Build the pull requests URI from the given parts.
     *
     * @return string
     */
    protected function buildPullRequestsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pullrequests', ...$parts);
    }
}
