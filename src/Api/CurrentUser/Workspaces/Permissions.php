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

namespace Bitbucket\Api\CurrentUser\Workspaces;

use Bitbucket\Api\CurrentUser\Workspaces\Permissions\Repositories;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The permissions API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Permissions extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function show(array $params = []): array
    {
        $uri = $this->buildWorkspacesUri('permission');

        return $this->get($uri, $params);
    }

    public function repositories(): Repositories
    {
        return new Repositories($this->getClient(), $this->workspace);
    }

    /**
     * Build the workspaces URI from the given parts.
     */
    protected function buildWorkspacesUri(string ...$parts): string
    {
        return UriBuilder::build('user', 'workspaces', $this->workspace, ...$parts);
    }
}
