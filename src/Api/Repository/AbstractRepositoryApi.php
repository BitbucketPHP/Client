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

namespace Bitbucket\Api\Repository;

use Bitbucket\Api\AbstractApi;
use Bitbucket\Client;

/**
 * The abstract repository api class.
 *
 * @author Graham Campbell <graham@alt-thre.com>
 */
abstract class AbstractRepositoryApi extends AbstractApi
{
    /**
     * The username.
     *
     * @var string
     */
    protected $username;

    /**
     * The repo.
     *
     * @var string
     */
    protected $repo;

    /**
     * Create a new api instance.
     *
     * @param \Bitbucket\Client $client
     * @param string            $username
     * @param string            $repo
     */
    public function __construct(Client $client, string $username, string $repo)
    {
        parent::__construct($client);
        $this->username = $username;
        $this->repo = $repo;
    }
}
