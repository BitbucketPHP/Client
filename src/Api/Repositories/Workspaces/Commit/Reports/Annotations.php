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

namespace Bitbucket\Api\Repositories\Workspaces\Commit\Reports;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The annotations API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Annotations extends AbstractReportsApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildAnnotationsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = $this->buildAnnotationsUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $annotation, array $params = []): array
    {
        $uri = $this->buildAnnotationsUri($annotation);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $annotation, array $params = []): array
    {
        $uri = $this->buildAnnotationsUri($annotation);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $annotation, array $params = []): array
    {
        $uri = $this->buildAnnotationsUri($annotation);

        return $this->delete($uri, $params);
    }

    /**
     * Annotations the build URI from the given parts.
     */
    protected function buildAnnotationsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'reports', 'annotations', ...$parts);
    }
}
