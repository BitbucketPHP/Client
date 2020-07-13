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

namespace Bitbucket\Api\Addon\Linkers;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The values API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Values extends AbstractLinkersApi
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
        $uri = UriBuilder::appendSeparator($this->buildValuesUri());

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $uri = UriBuilder::appendSeparator($this->buildValuesUri());

        return $this->post($uri, $params);
    }

    /**
     * @param string $id
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $id, array $params = [])
    {
        $uri = $this->buildValuesUri($id);

        return $this->get($uri, $params);
    }

    /**
     * @param string $id
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $id, array $params = [])
    {
        $uri = $this->buildValuesUri($id);

        return $this->put($uri, $params);
    }

    /**
     * @param string $id
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $id, array $params = [])
    {
        $uri = $this->buildValuesUri($id);

        return $this->delete($uri, $params);
    }

    /**
     * Build the values URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildValuesUri(string ...$parts)
    {
        return UriBuilder::build('addon', 'linkers', $this->linker, 'values', ...$parts);
    }
}
