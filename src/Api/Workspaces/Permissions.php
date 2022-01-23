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
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = [])
    {
        $uri = $this->buildPermissionsUri();

        return $this->get($uri, $params);
    }

    /**
     * @return \Bitbucket\Api\Workspaces\Permissions\Repositories
     */
    public function repositories()
    {
        return new Repositories($this->getClient(), $this->workspace);
    }

    /**
     * Build the permissions URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildPermissionsUri(string ...$parts)
    {
        return UriBuilder::build('workspaces', $this->workspace, 'permissions', ...$parts);
    }
}
