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

use Bitbucket\Api\Workspaces\Permissions\Repositories;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The permissions API class.
 *
 * @author Patrick Barsallo <p.d.barsallo@gmail.com>
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Permissions extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildPermissionsUri();

        return $this->get($uri, $params);
    }

    public function repositories(): Repositories
    {
        return new Repositories($this->getClient(), $this->workspace);
    }

    /**
     * Build the permissions URI from the given parts.
     */
    protected function buildPermissionsUri(string ...$parts): string
    {
        return UriBuilder::build('workspaces', $this->workspace, 'permissions', ...$parts);
    }
}
