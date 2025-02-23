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

namespace Bitbucket\Api\Repositories\Workspaces\Commit;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The comments API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Comments extends AbstractCommitApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = [])
    {
        $uri = $this->buildCommentsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $uri = $this->buildCommentsUri();

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $comment, array $params = [])
    {
        $uri = $this->buildCommentsUri($comment);

        return $this->get($uri, $params);
    }

    /**
     * Build the comments URI from the given parts.
     *
     * @return string
     */
    protected function buildCommentsUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'commit', $this->commit, 'comments', ...$parts);
    }
}
