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
 * The milestones API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Milestones extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildMilestonesUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $milestone, array $params = []): array
    {
        $uri = $this->buildMilestonesUri($milestone);

        return $this->get($uri, $params);
    }

    /**
     * Build the milestones URI from the given parts.
     */
    protected function buildMilestonesUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'milestones', ...$parts);
    }
}
