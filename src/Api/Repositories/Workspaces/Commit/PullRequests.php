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

namespace Bitbucket\Api\Repositories\Workspaces\Commit;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The pull requests API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class PullRequests extends AbstractCommitApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildPullRequestsUri();

        return $this->get($uri, $params);
    }

    /**
     * Build the pull requests URI from the given parts.
     */
    protected function buildPullRequestsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'pullrequests', ...$parts);
    }
}
