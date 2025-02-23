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

use Bitbucket\Api\Repositories\Workspaces\Commit\Approval;
use Bitbucket\Api\Repositories\Workspaces\Commit\Comments;
use Bitbucket\Api\Repositories\Workspaces\Commit\Properties as CommitProperties;
use Bitbucket\Api\Repositories\Workspaces\Commit\PullRequests as CommitPullRequests;
use Bitbucket\Api\Repositories\Workspaces\Commit\Reports;
use Bitbucket\Api\Repositories\Workspaces\Commit\Statuses;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The commit API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Commit extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $commit, array $params = []): array
    {
        $uri = $this->buildCommitUri($commit);

        return $this->get($uri, $params);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Commit\Approval
     */
    public function approval(string $commit): \Bitbucket\Api\Repositories\Workspaces\Commit\Approval
    {
        return new Approval($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Commit\Comments
     */
    public function comments(string $commit): \Bitbucket\Api\Repositories\Workspaces\Commit\Comments
    {
        return new Comments($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Commit\Properties
     */
    public function properties(string $commit): \Bitbucket\Api\Repositories\Workspaces\Commit\Properties
    {
        return new CommitProperties($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Commit\PullRequests
     */
    public function pullRequests(string $commit): \Bitbucket\Api\Repositories\Workspaces\Commit\PullRequests
    {
        return new CommitPullRequests($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Commit\Reports
     */
    public function reports(string $commit): \Bitbucket\Api\Repositories\Workspaces\Commit\Reports
    {
        return new Reports($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Commit\Statuses
     */
    public function statuses(string $commit): \Bitbucket\Api\Repositories\Workspaces\Commit\Statuses
    {
        return new Statuses($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    /**
     * Build the commit URI from the given parts.
     *
     * @return string
     */
    protected function buildCommitUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'commit', ...$parts);
    }
}
