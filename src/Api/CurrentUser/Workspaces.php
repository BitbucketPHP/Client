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

namespace Bitbucket\Api\CurrentUser;

use Bitbucket\Api\CurrentUser\Workspaces\Permissions;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The workspaces API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Workspaces extends AbstractCurrentUserApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildWorkspacesUri();

        return $this->get($uri, $params);
    }

    public function permissions(string $workspace): Permissions
    {
        return new Permissions($this->getClient(), $workspace);
    }

    /**
     * Build the workspaces URI from the given parts.
     */
    protected function buildWorkspacesUri(string ...$parts): string
    {
        return UriBuilder::build('user', 'workspaces', ...$parts);
    }
}
