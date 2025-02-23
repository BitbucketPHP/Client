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

use Bitbucket\Api\Repositories\Workspaces\Issues\Attachments;
use Bitbucket\Api\Repositories\Workspaces\Issues\Changes;
use Bitbucket\Api\Repositories\Workspaces\Issues\Comments;
use Bitbucket\Api\Repositories\Workspaces\Issues\Voting;
use Bitbucket\Api\Repositories\Workspaces\Issues\Watching;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The issues API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Issues extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildIssuesUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildIssuesUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $issue, array $params = []): array
    {
        $uri = $this->buildIssuesUri($issue);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $issue, array $params = []): array
    {
        $uri = $this->buildIssuesUri($issue);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $issue, array $params = []): array
    {
        $uri = $this->buildIssuesUri($issue);

        return $this->delete($uri, $params);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Issues\Attachments
     */
    public function attachments(string $issue): \Bitbucket\Api\Repositories\Workspaces\Issues\Attachments
    {
        return new Attachments($this->getClient(), $this->workspace, $this->repo, $issue);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Issues\Changes
     */
    public function changes(string $issue): \Bitbucket\Api\Repositories\Workspaces\Issues\Changes
    {
        return new Changes($this->getClient(), $this->workspace, $this->repo, $issue);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Issues\Comments
     */
    public function comments(string $issue): \Bitbucket\Api\Repositories\Workspaces\Issues\Comments
    {
        return new Comments($this->getClient(), $this->workspace, $this->repo, $issue);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Issues\Voting
     */
    public function voting(string $issue): \Bitbucket\Api\Repositories\Workspaces\Issues\Voting
    {
        return new Voting($this->getClient(), $this->workspace, $this->repo, $issue);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\Issues\Watching
     */
    public function watching(string $issue): \Bitbucket\Api\Repositories\Workspaces\Issues\Watching
    {
        return new Watching($this->getClient(), $this->workspace, $this->repo, $issue);
    }

    /**
     * Build the issues URI from the given parts.
     *
     * @return string
     */
    protected function buildIssuesUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'issues', ...$parts);
    }
}
