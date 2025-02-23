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

namespace Bitbucket\Api\Workspaces\Permissions;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The repositories API class.
 *
 * @author Patrick Barsallo <p.d.barsallo@gmail.com>
 */
class Repositories extends AbstractPermissionsApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildRepositoriesUri());

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $repo, array $params = []): array
    {
        $uri = $this->buildRepositoriesUri($repo);

        return $this->get($uri, $params);
    }

    /**
     * Build the repositories URI from the given parts.
     */
    protected function buildRepositoriesUri(string ...$parts): string
    {
        return UriBuilder::build('workspaces', $this->workspace, 'permissions', 'repositories', ...$parts);
    }
}
