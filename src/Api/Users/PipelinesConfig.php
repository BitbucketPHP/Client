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

namespace Bitbucket\Api\Users;

use Bitbucket\Api\Users\PipelinesConfig\Variables;

/**
 * The pipelines config api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class PipelinesConfig extends AbstractUsersApi
{
    /**
     * @return \Bitbucket\Api\Users\PipelinesConfig\Variables
     */
    public function variables()
    {
        return new Variables($this->getHttpClient(), $this->username);
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
        return static::buildPath('users', $this->username, 'pipelines_config', ...$parts);
    }
}
