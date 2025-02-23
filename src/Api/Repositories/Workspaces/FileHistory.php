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
 * The file history API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class FileHistory extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(string $commit, string $uri, array $params = []): array
    {
        $uri = $this->buildFileHistoryUri($commit, ...\explode('/', $uri));

        return $this->get($uri, $params);
    }

    /**
     * Build the file history URI from the given parts.
     */
    protected function buildFileHistoryUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'filehistory', ...$parts);
    }
}
