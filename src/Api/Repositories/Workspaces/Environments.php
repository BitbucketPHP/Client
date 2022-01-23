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
 * The environments API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Environments extends AbstractWorkspacesApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = [])
    {
        $uri = UriBuilder::appendSeparator($this->buildEnvironmentsUri());

        return $this->get($uri, $params);
    }

    /**
     * @param string $env
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $env, array $params = [])
    {
        $uri = $this->buildEnvironmentsUri($env);

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $uri = UriBuilder::appendSeparator($this->buildEnvironmentsUri());

        return $this->post($uri, $params);
    }

    /**
     * @param string $env
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $env, array $params = [])
    {
        $uri = UriBuilder::appendSeparator($this->buildEnvironmentsUri($env, 'changes'));

        return $this->put($uri, $params);
    }

    /**
     * @param string $env
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $env)
    {
        $uri = $this->buildEnvironmentsUri($env);

        return $this->delete($uri);
    }

    /**
     * Build the environments URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildEnvironmentsUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'environments', ...$parts);
    }
}
