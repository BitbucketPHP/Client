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

namespace Bitbucket\Api\Repositories\Users;

use Bitbucket\Api\Repositories\AbstractRepositoriesApi;
use Http\Client\Common\HttpMethodsClient;

/**
 * The abstract users api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractUsersApi extends AbstractRepositoriesApi
{
    /**
     * The repo.
     *
     * @var string
     */
    protected $repo;

    /**
     * Create a new api instance.
     *
     * @param \Http\Client\Common\HttpMethodsClient $client
     * @param string                                $username
     * @param string                                $repo
     */
    public function __construct(HttpMethodsClient $client, string $username, string $repo)
    {
        parent::__construct($client, $username);
        $this->repo = $repo;
    }
}
