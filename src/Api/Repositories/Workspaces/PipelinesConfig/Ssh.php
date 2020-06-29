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

namespace Bitbucket\Api\Repositories\Workspaces\PipelinesConfig;

use Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Ssh\KeyPair;
use Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Ssh\KnownHosts;

/**
 * The ssh api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Ssh extends AbstractPipelinesConfigApi
{
    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Ssh\KeyPair
     */
    public function keyPair()
    {
        return new KeyPair($this->getHttpClient(), $this->workspace, $this->repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Ssh\KnownHosts
     */
    public function knownHosts()
    {
        return new KnownHosts($this->getHttpClient(), $this->workspace, $this->repo);
    }

    /**
     * Build the ssh path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildSshPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->workspace, $this->repo, 'pipelines_config', 'ssh', ...$parts);
    }
}
