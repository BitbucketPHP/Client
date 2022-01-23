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

namespace Bitbucket\Api\Workspaces;

use Bitbucket\Api\Workspaces\PipelinesConfig\Variables;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The pipelines config API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class PipelinesConfig extends AbstractWorkspacesApi
{
    /**
     * @return \Bitbucket\Api\Workspaces\PipelinesConfig\Variables
     */
    public function variables()
    {
        return new Variables($this->getClient(), $this->workspace);
    }

    /**
     * Build the pipelines config URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildPipelinesConfigUri(string ...$parts)
    {
        return UriBuilder::build('workspaces', $this->workspace, 'pipelines_config', ...$parts);
    }
}
