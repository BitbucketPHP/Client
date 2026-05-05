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
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildIssuesUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildIssuesUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function show(string $issue, array $params = []): array
    {
        $uri = $this->buildIssuesUri($issue);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function update(string $issue, array $params = []): array
    {
        $uri = $this->buildIssuesUri($issue);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function remove(string $issue, array $params = []): array
    {
        $uri = $this->buildIssuesUri($issue);

        return $this->delete($uri, $params);
    }

    /**
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function attachments(string $issue): Attachments
    {
        return new Attachments($this->getClient(), $this->workspace, $this->repo, $issue);
    }

    /**
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function changes(string $issue): Changes
    {
        return new Changes($this->getClient(), $this->workspace, $this->repo, $issue);
    }

    /**
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function comments(string $issue): Comments
    {
        return new Comments($this->getClient(), $this->workspace, $this->repo, $issue);
    }

    /**
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function voting(string $issue): Voting
    {
        return new Voting($this->getClient(), $this->workspace, $this->repo, $issue);
    }

    /**
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function watching(string $issue): Watching
    {
        return new Watching($this->getClient(), $this->workspace, $this->repo, $issue);
    }

    /**
     * Build the issues URI from the given parts.
     */
    protected function buildIssuesUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'issues', ...$parts);
    }
}
