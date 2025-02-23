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
 * The diff stat API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class DiffStat extends AbstractPullRequestsApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function download(array $params = []): array
    {
        $uri = $this->buildDiffStatUri();

        return $this->get($uri, $params);
    }

    /**
     * Build the diff stat URI from the given parts.
     */
    protected function buildDiffStatUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pullrequests', $this->pr, 'diffstat', ...$parts);
    }
}
