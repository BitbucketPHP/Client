<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api\Repositories\Workspaces\Issues;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The watching class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Watching extends AbstractIssuesApi
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
        $uri = $this->buildWatchingUri();

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function watch(array $params = [])
    {
        $uri = $this->buildWatchingUri();

        return $this->put($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function ignore(array $params = [])
    {
        $uri = $this->buildWatchingUri();

        return $this->delete($uri, $params);
    }

    /**
     * Build the watching URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildWatchingUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'issues', $this->issue, 'watch', ...$parts);
    }
}
