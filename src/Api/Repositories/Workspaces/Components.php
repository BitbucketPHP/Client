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

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The components API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Components extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildComponentsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function show(string $component, array $params = []): array
    {
        $uri = $this->buildComponentsUri($component);

        return $this->get($uri, $params);
    }

    /**
     * Build the components URI from the given parts.
     */
    protected function buildComponentsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'components', ...$parts);
    }
}
