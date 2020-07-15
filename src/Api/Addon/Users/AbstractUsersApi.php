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

namespace Bitbucket\Api\Addon\Users;

use Bitbucket\Api\Addon\AbstractAddonApi;
use Bitbucket\Client;

/**
 * The abstract users API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractUsersApi extends AbstractAddonApi
{
    /**
     * The username.
     *
     * @var string
     */
    protected $username;

    /**
     * Create a new API instance.
     *
     * @param Client   $client
     * @param string   $username
     * @param int|null $perPage
     */
    public function __construct(Client $client, string $username, int $perPage = null)
    {
        parent::__construct($client, $perPage);
        $this->username = $username;
    }
}
