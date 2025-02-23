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

namespace Bitbucket\Api\Repositories\Workspaces\Refs;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The tags API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Tags extends AbstractRefsApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildTagsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildTagsUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $tag, array $params = []): array
    {
        $uri = $this->buildTagsUri($tag);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $tag, array $params = []): array
    {
        $uri = $this->buildTagsUri($tag);

        return $this->delete($uri, $params);
    }

    /**
     * Build the tags URI from the given parts.
     */
    protected function buildTagsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'refs', 'tags', ...$parts);
    }
}
