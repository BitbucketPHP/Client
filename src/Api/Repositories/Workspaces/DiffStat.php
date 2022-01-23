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
 * The diffs stat API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class DiffStat extends AbstractWorkspacesApi
{
    /**
     * @param string $spec
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function download(string $spec, array $params = [])
    {
        $uri = $this->buildDiffStatUri($spec);

        return $this->get($uri, $params);
    }

    /**
     * Build the diff stat URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildDiffStatUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'diffstat', ...$parts);
    }
}
