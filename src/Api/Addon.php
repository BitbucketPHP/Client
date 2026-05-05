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
     * @throws \Http\Client\Exception
     */
    public function update(array $params = []): array
    {
        $uri = $this->buildAddonUri();

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(array $params = []): array
    {
        $uri = $this->buildAddonUri();

        return $this->delete($uri, $params);
    }

    /**
     * @deprecated bitbucket has deprecated addon linker APIs
     */
    public function linkers(): Linkers
    {
        return new Linkers($this->getClient());
    }

    public function users(): UsersAddon
    {
        return new UsersAddon($this->getClient());
    }

    /**
     * Build the addon URI from the given parts.
     */
    protected function buildAddonUri(string ...$parts): string
    {
        return UriBuilder::build('addon', ...$parts);
    }
}
