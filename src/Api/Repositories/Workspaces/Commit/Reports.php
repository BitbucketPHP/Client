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

namespace Bitbucket\Api\Repositories\Workspaces\Commit;

use Bitbucket\Api\Repositories\Workspaces\Commit\Reports\Annotations;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The reports API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Reports extends AbstractCommitApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildReportsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(string $report, array $params = []): array
    {
        $uri = $this->buildReportsUri($report);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $report, array $params = []): array
    {
        $uri = $this->buildReportsUri($report);

        return $this->get($uri, $params);
    }

    public function annotations(): Annotations
    {
        return new Annotations($this->getClient(), $this->workspace, $this->repo, $this->commit);
    }

    /**
     * Build the reports URI from the given parts.
     */
    protected function buildReportsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'reports', ...$parts);
    }
}
