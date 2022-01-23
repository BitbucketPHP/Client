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

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The properties API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Properties extends AbstractWorkspacesApi
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
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'properties', ...$parts);
    }
}
