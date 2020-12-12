<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api\Addon\Users;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The events API class.
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
        $uri = $this->buildEventsUri($event);

        return $this->post($uri, $params);
    }

    /**
     * Build the events URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildEventsUri(string ...$parts)
    {
        return UriBuilder::build('addon', 'users', $this->username, 'events', ...$parts);
    }
}
