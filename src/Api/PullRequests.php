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

namespace Bitbucket\Api;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The pull requests API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class PullRequests extends AbstractApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(string $username, array $params = []): array
    {
        $uri = $this->buildPullRequestsUri($username);

        return $this->get($uri, $params);
    }

    /**
     * Build the pull requests URI from the given parts.
     */
    protected function buildPullRequestsUri(string ...$parts): string
    {
        return UriBuilder::build('pullrequests', ...$parts);
    }
}
