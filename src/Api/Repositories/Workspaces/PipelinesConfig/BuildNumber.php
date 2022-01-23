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

namespace Bitbucket\Api\Repositories\Workspaces\PipelinesConfig;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The build number API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
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
        $uri = $this->buildBuildNumberUri();

        return $this->put($uri, $params);
    }

    /**
     * Build the build number URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildBuildNumberUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines_config', 'build_number', ...$parts);
    }
}
