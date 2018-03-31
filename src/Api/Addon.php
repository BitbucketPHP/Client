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

namespace Bitbucket\Api;

use Bitbucket\Api\Addon\Linkers;

/**
 * The addon api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
        $path = $this->buildAddonPath();

        return $this->put($path, $params);
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
        $path = $this->buildAddonPath();

        return $this->delete($path, $params);
    }

    /**
     * @return \Bitbucket\Api\Addon\Linkers
     */
    public function linkers()
    {
        return new Linkers($this->getHttpClient());
    }

    /**
     * Build the addon path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildAddonPath(string ...$parts)
    {
        return static::buildPath('addon', ...$parts);
    }
}
