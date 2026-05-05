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

namespace Bitbucket\Api\Addon\Linkers;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The values API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Values extends AbstractLinkersApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated addon linker APIs
     */
    public function list(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildValuesUri());

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated addon linker APIs
     */
    public function create(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildValuesUri());

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated addon linker APIs
     */
    public function show(string $id, array $params = []): array
    {
        $uri = $this->buildValuesUri($id);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated addon linker APIs
     */
    public function update(string $id, array $params = []): array
    {
        $uri = $this->buildValuesUri($id);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated addon linker APIs
     */
    public function remove(string $id, array $params = []): array
    {
        $uri = $this->buildValuesUri($id);

        return $this->delete($uri, $params);
    }

    /**
     * Build the values URI from the given parts.
     */
    protected function buildValuesUri(string ...$parts): string
    {
        return UriBuilder::build('addon', 'linkers', $this->linker, 'values', ...$parts);
    }
}
