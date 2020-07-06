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

namespace Bitbucket\Api\Repositories\Workspaces\Issues;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The voting class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Voting extends AbstractIssuesApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function check(array $params = [])
    {
        $uri = $this->buildVotingUri();

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function vote(array $params = [])
    {
        $uri = $this->buildVotingUri();

        return $this->put($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function retract(array $params = [])
    {
        $uri = $this->buildVotingUri();

        return $this->delete($uri, $params);
    }

    /**
     * Build the voting URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildVotingUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'issues', $this->issue, 'vote', ...$parts);
    }
}
