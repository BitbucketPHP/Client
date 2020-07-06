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

namespace Bitbucket\Api\Repositories\Workspaces\Commit;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The properties api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Properties extends AbstractCommitApi
{
    /**
     * @param string $app
     * @param string $property
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $app, string $property, array $params = [])
    {
        $uri = $this->buildPropertiesUri($app, $property);

        return $this->get($uri, $params);
    }

    /**
     * @param string $app
     * @param string $property
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $app, string $property, array $params = [])
    {
        $uri = $this->buildPropertiesUri($app, $property);

        return $this->put($uri, $params);
    }

    /**
     * @param string $app
     * @param string $property
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $app, string $property, array $params = [])
    {
        $uri = $this->buildPropertiesUri($app, $property);

        return $this->delete($uri, $params);
    }

    /**
     * Build the properties URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildPropertiesUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'properties', ...$parts);
    }
}
