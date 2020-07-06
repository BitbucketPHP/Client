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

namespace Bitbucket\Api\Repositories\Workspaces;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The components api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Components extends AbstractWorkspacesApi
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
        $uri = $this->buildComponentsUri();

        return $this->get($uri, $params);
    }

    /**
     * @param string $component
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $component, array $params = [])
    {
        $uri = $this->buildComponentsUri($component);

        return $this->get($uri, $params);
    }

    /**
     * Build the components URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildComponentsUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'components', ...$parts);
    }
}
