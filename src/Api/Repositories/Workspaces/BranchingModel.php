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
 * The branching model API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class BranchingModel extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function show(array $params = []): array
    {
        $uri = $this->buildBranchingModelUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function showSettings(array $params = []): array
    {
        $uri = $this->buildBranchingModelUri('settings');

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function updateSettings(array $params = []): array
    {
        $uri = $this->buildBranchingModelUri('settings');

        return $this->put($uri, $params);
    }

    /**
     * Build the branching model URI from the given parts.
     */
    protected function buildBranchingModelUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'branching-model', ...$parts);
    }
}
