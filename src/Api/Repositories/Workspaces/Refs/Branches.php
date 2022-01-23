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

namespace Bitbucket\Api\Repositories\Workspaces\Refs;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The branches API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Branches extends AbstractRefsApi
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
        $uri = $this->buildBranchesUri();

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
        $uri = $this->buildBranchesUri();

        return $this->post($uri, $params);
    }

    /**
     * @param string $branch
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $branch, array $params = [])
    {
        $uri = $this->buildBranchesUri($branch);

        return $this->get($uri, $params);
    }

    /**
     * @param string $branch
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $branch, array $params = [])
    {
        $uri = $this->buildBranchesUri($branch);

        return $this->delete($uri, $params);
    }

    /**
     * Build the branches URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildBranchesUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'refs', 'branches', ...$parts);
    }
}
