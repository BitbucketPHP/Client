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
 * The forks API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Forks extends AbstractWorkspacesApi
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
        $uri = $this->buildForksUri();

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
        $uri = $this->buildForksUri();

        return $this->post($uri, $params);
    }

    /**
     * Build the forks URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildForksUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'forks', ...$parts);
    }
}
