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

namespace Bitbucket\Api\Addon\Users;

use Bitbucket\Api\Addon\AbstractAddonApi;
use Bitbucket\Client;

/**
 * The abstract users API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
abstract class AbstractUsersApi extends AbstractAddonApi
{
    protected readonly string $username;

    public function __construct(Client $client, string $username)
    {
        parent::__construct($client);
        $this->username = $username;
    }
}
