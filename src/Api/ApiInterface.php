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

/**
 * The bitbucket api interface.
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
interface ApiInterface
{
    /**
     * Get the number of values to fetch per page.
     *
     * @return int|null
     */
    public function getPerPage();

    /**
     * Set the number of values to fetch per page.
     *
     * @param int|null $perPage
     *
     * @return void
     */
    public function setPerPage(int $perPage = null);
}
