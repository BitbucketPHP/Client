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

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The default reviewers API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class DefaultReviewers extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildDefaultReviewersUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $reviewer, array $params = []): array
    {
        $uri = $this->buildDefaultReviewersUri($reviewer);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function add(string $reviewer, array $params = []): array
    {
        $uri = $this->buildDefaultReviewersUri($reviewer);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $reviewer, array $params = []): array
    {
        $uri = $this->buildDefaultReviewersUri($reviewer);

        return $this->delete($uri, $params);
    }

    /**
     * Build the default reviewers URI from the given parts.
     */
    protected function buildDefaultReviewersUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'default-reviewers', ...$parts);
    }
}
