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

namespace Bitbucket\Api\Repositories;

use Bitbucket\Api\Repositories\PullRequests\Approval;
use Bitbucket\Api\Repositories\PullRequests\Comments;
use Bitbucket\Api\Repositories\PullRequests\Commits as PullRequestsCommits;
use Bitbucket\Api\Repositories\PullRequests\Diff;
use Bitbucket\Api\Repositories\PullRequests\Patch;
use Bitbucket\Api\Repositories\PullRequests\Statuses;

/**
 * The pull requests api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class PullRequests extends AbstractRepositoriesApi
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
     * @return \Bitbucket\Api\Repositories\PullRequests\Approval
     */
    public function approval(string $pr)
    {
        return new Approval($this->getHttpClient(), $this->username, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\PullRequests\Comments
     */
    public function comments(string $pr)
    {
        return new Comments($this->getHttpClient(), $this->username, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\PullRequests\Commits
     */
    public function commits(string $pr)
    {
        return new PullRequestsCommits($this->getHttpClient(), $this->username, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\PullRequests\Diff
     */
    public function diff(string $pr)
    {
        return new Diff($this->getHttpClient(), $this->username, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\PullRequests\Patch
     */
    public function patch(string $pr)
    {
        return new Patch($this->getHttpClient(), $this->username, $this->repo, $pr);
    }

    /**
     * @param string $pr
     *
     * @return \Bitbucket\Api\Repositories\PullRequests\Statuses
     */
    public function statuses(string $pr)
    {
        return new Statuses($this->getHttpClient(), $this->username, $this->repo, $pr);
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
        return static::buildPath('repositories', $this->username, $this->repo, 'pullrequests', ...$parts);
    }
}
