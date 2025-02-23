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

namespace Bitbucket\Api\Snippets\Workspaces;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The comments API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Comments extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildCommentsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildCommentsUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $comment, array $params = []): array
    {
        $uri = $this->buildCommentsUri($comment);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $comment, array $params = []): array
    {
        $uri = $this->buildCommentsUri($comment);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $comment, array $params = []): array
    {
        $uri = $this->buildCommentsUri($comment);

        return $this->delete($uri, $params);
    }

    /**
     * Build the comments URI from the given parts.
     *
     * @return string
     */
    protected function buildCommentsUri(string ...$parts): string
    {
        return UriBuilder::build('snippets', $this->workspace, $this->snippet, 'comments', ...$parts);
    }
}
