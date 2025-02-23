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

namespace Bitbucket\Api\Workspaces;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The members API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Members extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildMembersUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $member, array $params = []): array
    {
        $uri = $this->buildMembersUri($member);

        return $this->get($uri, $params);
    }

    /**
     * Build the members URI from the given parts.
     */
    protected function buildMembersUri(string ...$parts): string
    {
        return UriBuilder::build('workspaces', $this->workspace, 'members', ...$parts);
    }
}
