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

namespace Bitbucket\Api\Repositories\Workspaces\PullRequests;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The patch API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Patch extends AbstractPullRequestsApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function download(array $params = []): \Psr\Http\Message\StreamInterface
    {
        $uri = $this->buildPatchUri();

        return $this->getAsResponse($uri, $params, ['Accept' => 'text/plain'])->getBody();
    }

    /**
     * Build the patch URI from the given parts.
     */
    protected function buildPatchUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pullrequests', $this->pr, 'patch', ...$parts);
    }
}
