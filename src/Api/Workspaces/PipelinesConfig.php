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

namespace Bitbucket\Api\Workspaces;

use Bitbucket\Api\Workspaces\PipelinesConfig\Variables;

/**
 * The pipelines config api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class PipelinesConfig extends AbstractWorkspacesApi
{
    /**
     * @return \Bitbucket\Api\Workspaces\PipelinesConfig\Variables
     */
    public function variables()
    {
        return new Variables($this->getHttpClient(), $this->workspace);
    }

    /**
     * Build the pipelines config path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildPipelinesConfigPath(string ...$parts)
    {
        return static::buildPath('workspaces', $this->workspace, 'pipelines_config', ...$parts);
    }
}
