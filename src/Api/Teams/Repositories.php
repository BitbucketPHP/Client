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

namespace Bitbucket\Api\Teams;

/**
 * The repositories api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Repositories extends AbstractTeamsApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = [])
    {
        $path = $this->buildRepositoriesPath();

        return $this->get($path, $params);
    }

    /**
     * Build the repositories path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildRepositoriesPath(string ...$parts)
    {
        return static::buildPath('teams', $this->username, 'repositories', ...$parts);
    }
}
