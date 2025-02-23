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
     */
    public function show(string $commit, array $params = []): array
    {
        $uri = $this->buildCommitUri($commit);

        return $this->get($uri, $params);
    }

    public function approval(string $commit): Approval
    {
        return new Approval($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    public function comments(string $commit): Comments
    {
        return new Comments($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    public function properties(string $commit): CommitProperties
    {
        return new CommitProperties($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    public function pullRequests(string $commit): CommitPullRequests
    {
        return new CommitPullRequests($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    public function reports(string $commit): Reports
    {
        return new Reports($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    public function statuses(string $commit): Statuses
    {
        return new Statuses($this->getClient(), $this->workspace, $this->repo, $commit);
    }

    /**
     * Build the commit URI from the given parts.
     */
    protected function buildCommitUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'commit', ...$parts);
    }
}
