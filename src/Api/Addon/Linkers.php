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

namespace Bitbucket\Api\Addon;

use Bitbucket\Api\Addon\Linkers\Values;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The linkers API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Linkers extends AbstractAddonApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated addon linker APIs
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildLinkersUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated addon linker APIs
     */
    public function show(string $linker, array $params = []): array
    {
        $uri = $this->buildLinkersUri($linker);

        return $this->get($uri, $params);
    }

    /**
     * @deprecated bitbucket has deprecated addon linker APIs
     */
    public function values(string $linker): Values
    {
        return new Values($this->getClient(), $linker);
    }

    /**
     * Build the linkers URI from the given parts.
     */
    protected function buildLinkersUri(string ...$parts): string
    {
        return UriBuilder::build('addon', 'linkers', ...$parts);
    }
}
