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

namespace Bitbucket\Api;

use Bitbucket\Api\Addon\Linkers;
use Bitbucket\Api\Addon\Users as UsersAddon;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The addon API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Addon extends AbstractApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(array $params = [])
    {
        $uri = $this->buildAddonUri();

        return $this->put($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(array $params = [])
    {
        $uri = $this->buildAddonUri();

        return $this->delete($uri, $params);
    }

    /**
     * @return \Bitbucket\Api\Addon\Linkers
     */
    public function linkers()
    {
        return new Linkers($this->getClient());
    }

    /**
     * @return \Bitbucket\Api\Addon\Users
     */
    public function users()
    {
        return new UsersAddon($this->getClient());
    }

    /**
     * Build the addon URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildAddonUri(string ...$parts)
    {
        return UriBuilder::build('addon', ...$parts);
    }
}
