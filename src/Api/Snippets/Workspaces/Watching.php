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

namespace Bitbucket\Api\Snippets\Workspaces;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The watching API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Watching extends AbstractWorkspacesApi
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
        return UriBuilder::build('snippets', $this->workspace, $this->snippet, 'watch', ...$parts);
    }
}
