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

namespace Bitbucket\Api\Addon\Users;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The events API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Events extends AbstractUsersApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(string $event, array $params = []): array
    {
        $uri = $this->buildEventsUri($event);

        return $this->post($uri, $params);
    }

    /**
     * Build the events URI from the given parts.
     *
     * @return string
     */
    protected function buildEventsUri(string ...$parts): string
    {
        return UriBuilder::build('addon', 'users', $this->username, 'events', ...$parts);
    }
}
