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

namespace Bitbucket\Api\Snippets\Workspaces;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The commits API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Commits extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildCommitsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $commit, array $params = []): array
    {
        $uri = $this->buildCommitsUri($commit);

        return $this->get($uri, $params);
    }

    /**
     * Build the commits URI from the given parts.
     */
    protected function buildCommitsUri(string ...$parts): string
    {
        return UriBuilder::build('snippets', $this->workspace, $this->snippet, 'commits', ...$parts);
    }
}
