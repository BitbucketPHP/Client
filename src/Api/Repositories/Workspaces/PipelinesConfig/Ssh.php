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

use Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Ssh\KeyPair;
use Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Ssh\KnownHosts;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The ssh API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Ssh extends AbstractPipelinesConfigApi
{
    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Ssh\KeyPair
     */
    public function keyPair()
    {
        return new KeyPair($this->getClient(), $this->workspace, $this->repo);
    }

    /**
     * @return \Bitbucket\Api\Repositories\Workspaces\PipelinesConfig\Ssh\KnownHosts
     */
    public function knownHosts()
    {
        return new KnownHosts($this->getClient(), $this->workspace, $this->repo);
    }

    /**
     * Build the ssh URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildSshUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'pipelines_config', 'ssh', ...$parts);
    }
}
