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

namespace Bitbucket\Api\Repositories\Workspaces\Commit\Statuses;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The build API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Build extends AbstractStatusesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildBuildUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $key, array $params = []): array
    {
        $uri = $this->buildBuildUri(...\explode('/', $key));

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $key, array $params = []): array
    {
        $uri = $this->buildBuildUri(...\explode('/', $key));

        return $this->put($uri, $params);
    }

    /**
     * Build the build URI from the given parts.
     */
    protected function buildBuildUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'statuses', 'build', ...$parts);
    }
}
