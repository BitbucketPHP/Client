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
 * The effective branching model API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class EffectiveBranchingModel extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function show(array $params = []): array
    {
        $uri = $this->buildEffectiveBranchingModelUri();

        return $this->get($uri, $params);
    }

    /**
     * Build the effective branching model URI from the given parts.
     */
    protected function buildEffectiveBranchingModelUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'effective-branching-model', ...$parts);
    }
}
