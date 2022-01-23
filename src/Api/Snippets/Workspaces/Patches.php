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
 * The patches API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Patches extends AbstractWorkspacesApi
{
    /**
     * @param string $commit
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function download(string $commit, array $params = [])
    {
        $uri = $this->buildPatchesUri($commit, 'patch');

        return $this->getAsResponse($uri, $params, ['Accept' => 'text/plain'])->getBody();
    }

    /**
     * Build the patches URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildPatchesUri(string ...$parts)
    {
        return UriBuilder::build('snippets', $this->workspace, $this->snippet, ...$parts);
    }
}
