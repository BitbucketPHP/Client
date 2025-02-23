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

use Bitbucket\Api\Repositories\Workspaces\Commit\Statuses\Build;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The statuses API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Statuses extends AbstractCommitApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildStatusesUri();

        return $this->get($uri, $params);
    }

    public function build(): Build
    {
        return new Build($this->getClient(), $this->workspace, $this->repo, $this->commit);
    }

    /**
     * Build the statuses URI from the given parts.
     */
    protected function buildStatusesUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'statuses', ...$parts);
    }
}
