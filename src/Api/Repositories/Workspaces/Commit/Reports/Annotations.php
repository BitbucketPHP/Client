<?php

declare(strict_types=1);

/*
 * This file is part of Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api\Repositories\Workspaces\Commit\Reports;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The annotations api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Annotations extends AbstractReportsApi
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
        $uri = $this->buildAnnotationsUri();

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $uri = $this->buildAnnotationsUri();

        return $this->post($uri, $params);
    }

    /**
     * @param string $annotation
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $annotation, array $params = [])
    {
        $uri = $this->buildAnnotationsUri($annotation);

        return $this->get($uri, $params);
    }

    /**
     * @param string $annotation
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $annotation, array $params = [])
    {
        $uri = $this->buildAnnotationsUri($annotation);

        return $this->put($uri, $params);
    }

    /**
     * @param string $annotation
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $annotation, array $params = [])
    {
        $uri = $this->buildAnnotationsUri($annotation);

        return $this->delete($uri, $params);
    }

    /**
     * Annotations the build URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildAnnotationsUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'reports', 'annotations', ...$parts);
    }
}
