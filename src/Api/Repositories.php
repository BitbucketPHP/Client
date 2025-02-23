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

namespace Bitbucket\Api;

use Bitbucket\Api\Repositories\Workspaces as RepositoriesWorkspaces;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The repositories API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Repositories extends AbstractApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildRepositoriesUri();

        return $this->get($uri, $params);
    }

    public function workspaces(string $workspace): RepositoriesWorkspaces
    {
        return new RepositoriesWorkspaces($this->getClient(), $workspace);
    }

    /**
     * Build the repositories URI from the given parts.
     */
    protected function buildRepositoriesUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', ...$parts);
    }
}
