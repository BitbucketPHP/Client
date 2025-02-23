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

namespace Bitbucket\Api\Repositories\Workspaces\PullRequests;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The comments API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Comments extends AbstractPullRequestsApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildCommentsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $comment, array $params = []): array
    {
        $uri = $this->buildCommentsUri($comment);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildCommentsUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $comment, array $params = []): array
    {
        $uri = $this->buildCommentsUri($comment);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $comment): array
    {
        $uri = $this->buildCommentsUri($comment);

        return $this->delete($uri);
    }

    /**
     * Build the comments URI from the given parts.
     */
    protected function buildCommentsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pullrequests', $this->pr, 'comments', ...$parts);
    }
}
