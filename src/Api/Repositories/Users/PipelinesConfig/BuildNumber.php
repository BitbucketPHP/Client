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

namespace Bitbucket\Api\Repositories\Users\PipelinesConfig;

/**
 * The build number api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class BuildNumber extends AbstractPipelinesConfigApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(array $params = [])
    {
        $path = $this->buildBuildNumberPath();

        return $this->put($path, $params);
    }

    /**
     * Build the build number path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildBuildNumberPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'pipelines_config', 'build_number', ...$parts);
    }
}
