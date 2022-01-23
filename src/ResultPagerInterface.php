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

namespace Bitbucket;

use Bitbucket\Api\AbstractApi;
use Generator;

/**
 * This is the result pager interface.
 *
 * @author Ramon de la Fuente <ramon@future500.nl>
 * @author Mitchel Verschoof <mitchel@future500.nl>
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
interface ResultPagerInterface
{
    /**
     * Fetch a single result from an api call.
     *
     * @param \Bitbucket\Api\AbstractApi $api
     * @param string                     $method
     * @param array                      $parameters
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetch(AbstractApi $api, string $method, array $parameters = []): array;

    /**
     * Fetch all results from an api call.
     *
     * @param \Bitbucket\Api\AbstractApi $api
     * @param string                     $method
     * @param array                      $parameters
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetchAll(AbstractApi $api, string $method, array $parameters = []): array;

    /**
     * Lazily fetch all results from an api call.
     *
     * @param \Bitbucket\Api\AbstractApi $api
     * @param string                     $method
     * @param array                      $parameters
     *
     * @throws \Http\Client\Exception
     *
     * @return \Generator
     */
    public function fetchAllLazy(AbstractApi $api, string $method, array $parameters = []): Generator;

    /**
     * Check to determine the availability of a next page.
     *
     * @return bool
     */
    public function hasNext(): bool;

    /**
     * Fetch the next page.
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetchNext(): array;

    /**
     * Check to determine the availability of a previous page.
     *
     * @return bool
     */
    public function hasPrevious(): bool;

    /**
     * Fetch the previous page.
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetchPrevious(): array;
}
