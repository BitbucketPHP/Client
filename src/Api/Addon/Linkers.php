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

namespace Bitbucket\Api\Addon;

use Bitbucket\Api\Addon\Linkers\Values;

/**
 * The linkers api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Linkers extends AbstractAddonApi
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
        $path = $this->buildLinkersPath();

        return $this->get($path, $params);
    }

    /**
     * @param string $linker
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $linker, array $params = [])
    {
        $path = $this->buildLinkersPath($linker);

        return $this->get($path, $params);
    }

    /**
     * @param string $linker
     *
     * @return \Bitbucket\Api\Addon\Linkers\Values
     */
    public function values(string $linker)
    {
        return new Values($this->getHttpClient(), $linker);
    }

    /**
     * Build the linkers path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildLinkersPath(string ...$parts)
    {
        return static::buildPath('addon', 'linkers', ...$parts);
    }
}
