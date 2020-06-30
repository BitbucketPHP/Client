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
        $path = $this->buildAnnotationsPath();

        return $this->get($path, $params);
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
        $path = $this->buildAnnotationsPath();

        return $this->post($path, $params);
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
        $path = $this->buildAnnotationsPath($annotation);

        return $this->get($path, $params);
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
        $path = $this->buildAnnotationsPath($annotation);

        return $this->put($path, $params);
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
        $path = $this->buildAnnotationsPath($annotation);

        return $this->delete($path, $params);
    }

    /**
     * Annotations the build path from the given parts.
     *
     * @param string ...$parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildAnnotationsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'reports', 'annotations', ...$parts);
    }
}
