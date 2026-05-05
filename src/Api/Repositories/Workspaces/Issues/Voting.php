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
 * The voting class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Voting extends AbstractIssuesApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function check(array $params = []): array
    {
        $uri = $this->buildVotingUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function vote(array $params = []): array
    {
        $uri = $this->buildVotingUri();

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function retract(array $params = []): array
    {
        $uri = $this->buildVotingUri();

        return $this->delete($uri, $params);
    }

    /**
     * Build the voting URI from the given parts.
     */
    protected function buildVotingUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'issues', $this->issue, 'vote', ...$parts);
    }
}
