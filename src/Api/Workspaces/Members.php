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
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = [])
    {
        $uri = $this->buildMembersUri();

        return $this->get($uri, $params);
    }

    /**
     * @param string $member
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $member, array $params = [])
    {
        $uri = $this->buildMembersUri($member);

        return $this->get($uri, $params);
    }

    /**
     * Build the members URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildMembersUri(string ...$parts)
    {
        return UriBuilder::build('workspaces', $this->workspace, 'members', ...$parts);
    }
}
