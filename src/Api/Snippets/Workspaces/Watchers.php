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
 * The watchers API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Watchers extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated listing snippet watchers
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildWatchersUri();

        return $this->get($uri, $params);
    }

    /**
     * Build the watchers URI from the given parts.
     */
    protected function buildWatchersUri(string ...$parts): string
    {
        return UriBuilder::build('snippets', $this->workspace, $this->snippet, 'watchers', ...$parts);
    }
}
