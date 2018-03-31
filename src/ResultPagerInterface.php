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

namespace Bitbucket;

use Bitbucket\Api\ApiInterface;

/**
 * This is the result pager interface.
 *
 * @author Ramon de la Fuente <ramon@future500.nl>
 * @author Mitchel Verschoof <mitchel@future500.nl>
 * @author Graham Campbell <graham@alt-three.com>
 */
interface ResultPagerInterface
{
    /**
     * Get the pagination result of the last request.
     *
     * @return array|null
     */
    public function getPagination();

    /**
     * Fetch a single result from an api call.
     *
     * @param \Bitbucket\Api\ApiInterface $api
     * @param string                      $method
     * @param array                       $parameters
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetch(ApiInterface $api, $method, array $parameters = []);

    /**
     * Fetch all results from an api call.
     *
     * @param \Bitbucket\Api\ApiInterface $api
     * @param string                      $method
     * @param array                       $parameters
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetchAll(ApiInterface $api, $method, array $parameters = []);

    /**
     * Method that performs the actual work to refresh the pagination property.
     *
     * @return void
     */
    public function postFetch();

    /**
     * Check to determine the availability of a next page.
     *
     * @return bool
     */
    public function hasNext();

    /**
     * Fetch the next page.
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetchNext();

    /**
     * Check to determine the availability of a previous page.
     *
     * @return bool
     */
    public function hasPrevious();

    /**
     * Fetch the previous page.
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function fetchPrevious();
}
