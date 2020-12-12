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

namespace Bitbucket\Api\Addon;

use Bitbucket\Api\Addon\Linkers\Values;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The linkers API class.
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
        $uri = $this->buildLinkersUri();

        return $this->get($uri, $params);
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
        $uri = $this->buildLinkersUri($linker);

        return $this->get($uri, $params);
    }

    /**
     * @param string $linker
     *
     * @return \Bitbucket\Api\Addon\Linkers\Values
     */
    public function values(string $linker)
    {
        return new Values($this->getClient(), $linker);
    }

    /**
     * Build the linkers URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildLinkersUri(string ...$parts)
    {
        return UriBuilder::build('addon', 'linkers', ...$parts);
    }
}
