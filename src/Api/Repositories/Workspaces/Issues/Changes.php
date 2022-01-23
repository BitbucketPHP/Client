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

namespace Bitbucket\Api\Repositories\Workspaces\Issues;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The changes API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Changes extends AbstractIssuesApi
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
        $uri = $this->buildChangesUri();

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
        $uri = $this->buildChangesUri();

        return $this->post($uri, $params);
    }

    /**
     * @param string $change
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $change, array $params = [])
    {
        $uri = $this->buildChangesUri($change);

        return $this->get($uri, $params);
    }

    /**
     * Build the changes URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildChangesUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'issues', $this->issue, 'changes', ...$parts);
    }
}
