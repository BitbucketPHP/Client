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
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = [])
    {
        $uri = $this->buildDefaultReviewersUri();

        return $this->get($uri, $params);
    }

    /**
     * @param string $reviewer
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $reviewer, array $params = [])
    {
        $uri = $this->buildDefaultReviewersUri($reviewer);

        return $this->get($uri, $params);
    }

    /**
     * @param string $reviewer
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function add(string $reviewer, array $params = [])
    {
        $uri = $this->buildDefaultReviewersUri($reviewer);

        return $this->put($uri, $params);
    }

    /**
     * @param string $reviewer
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $reviewer, array $params = [])
    {
        $uri = $this->buildDefaultReviewersUri($reviewer);

        return $this->delete($uri, $params);
    }

    /**
     * Build the default reviewers URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildDefaultReviewersUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'default-reviewers', ...$parts);
    }
}
