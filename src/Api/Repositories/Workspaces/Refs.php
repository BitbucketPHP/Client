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

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\Api\Repositories\Workspaces\Refs\Branches;
use Bitbucket\Api\Repositories\Workspaces\Refs\Tags;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The refs API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Refs extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildRefsUri();

        return $this->get($uri, $params);
    }

    public function branches(): Branches
    {
        return new Branches($this->getClient(), $this->workspace, $this->repo);
    }

    public function tags(): Tags
    {
        return new Tags($this->getClient(), $this->workspace, $this->repo);
    }

    /**
     * Build the refs URI from the given parts.
     */
    protected function buildRefsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'refs', ...$parts);
    }
}
