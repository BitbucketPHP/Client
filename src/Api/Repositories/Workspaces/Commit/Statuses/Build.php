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

namespace Bitbucket\Api\Repositories\Workspaces\Commit\Statuses;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The build API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Build extends AbstractStatusesApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $uri = $this->buildBuildUri();

        return $this->post($uri, $params);
    }

    /**
     * @param string $key
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $key, array $params = [])
    {
        $uri = $this->buildBuildUri(...\explode('/', $key));

        return $this->get($uri, $params);
    }

    /**
     * @param string $key
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $key, array $params = [])
    {
        $uri = $this->buildBuildUri(...\explode('/', $key));

        return $this->put($uri, $params);
    }

    /**
     * Build the build URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildBuildUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'statuses', 'build', ...$parts);
    }
}
