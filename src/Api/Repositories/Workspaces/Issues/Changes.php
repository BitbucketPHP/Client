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

namespace Bitbucket\Api\Repositories\Workspaces\Issues;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The changes API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Changes extends AbstractIssuesApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildChangesUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildChangesUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function show(string $change, array $params = []): array
    {
        $uri = $this->buildChangesUri($change);

        return $this->get($uri, $params);
    }

    /**
     * Build the changes URI from the given parts.
     */
    protected function buildChangesUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'issues', $this->issue, 'changes', ...$parts);
    }
}
