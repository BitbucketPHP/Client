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

namespace Bitbucket\Api\Addon\Users;

/**
 * The events api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Events extends AbstractUsersApi
{
    /**
     * @param string $event
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(string $event, array $params = [])
    {
        $path = $this->buildEventsPath($event);

        return $this->post($path, $params);
    }

    /**
     * Build the events path from the given parts.
     *
     * @param string ...$parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildEventsPath(string ...$parts)
    {
        return static::buildPath('addon', 'users', $this->username, 'events', ...$parts);
    }
}
