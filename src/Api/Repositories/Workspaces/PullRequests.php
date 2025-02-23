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
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildPullRequestsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function activity(array $params = []): array
    {
        $uri = $this->buildPullRequestsUri('activity');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildPullRequestsUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $pr, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function activityByPr(string $pr, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr, 'activity');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $pr, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function decline(string $pr, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr, 'decline');

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function merge(string $pr, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr, 'merge');

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function mergeTaskStatus(string $pr, string $task, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($pr, 'merge', 'task-status', $task);

        return $this->get($uri, $params);
    }

    public function approval(string $pr): Approval
    {
        return new Approval($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    public function comments(string $pr): Comments
    {
        return new Comments($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    public function commits(string $pr): PullRequestsCommits
    {
        return new PullRequestsCommits($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    public function diff(string $pr): Diff
    {
        return new Diff($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    public function diffstat(string $pr): DiffStat
    {
        return new DiffStat($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    public function patch(string $pr): Patch
    {
        return new Patch($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    public function properties(string $pr): PullRequestsProperties
    {
        return new PullRequestsProperties($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    public function statuses(string $pr): Statuses
    {
        return new Statuses($this->getClient(), $this->workspace, $this->repo, $pr);
    }

    /**
     * Build the pull requests URI from the given parts.
     */
    protected function buildPullRequestsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pullrequests', ...$parts);
    }
}
