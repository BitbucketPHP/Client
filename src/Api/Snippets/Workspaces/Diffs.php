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
 * The diffs API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Diffs extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function download(string $commit, array $params = []): \Psr\Http\Message\StreamInterface
    {
        $uri = $this->buildDiffsUri($commit, 'diff');

        return $this->getAsResponse($uri, $params, ['Accept' => 'text/plain'])->getBody();
    }

    /**
     * Build the diffs URI from the given parts.
     */
    protected function buildDiffsUri(string ...$parts): string
    {
        return UriBuilder::build('snippets', $this->workspace, $this->snippet, ...$parts);
    }
}
