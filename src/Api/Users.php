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

use Bitbucket\Api\Users\Properties;
use Bitbucket\Api\Users\Repositories as UsersRepositories;
use Bitbucket\Api\Users\SshKeys;
use Bitbucket\Client;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The users API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Users extends AbstractApi
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
     *
     * @return void
     */
    public function __construct(Client $client, string $username, int $perPage = null)
    {
        parent::__construct($client, $perPage);
        $this->username = $username;
    }

    /**
     * @return \Bitbucket\Api\Users\Properties
     */
    public function properties()
    {
        return new Properties($this->getClient(), $this->username, $this->getPerPage());
    }

    /**
     * @return \Bitbucket\Api\Users\Repositories
     */
    public function repositories()
    {
        return new UsersRepositories($this->getClient(), $this->username, $this->getPerPage());
    }

    /**
     * @return \Bitbucket\Api\Users\SshKeys
     */
    public function sshKeys()
    {
        return new SshKeys($this->getClient(), $this->username, $this->getPerPage());
    }

    /**
     * Build the users URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildUsersUri(string ...$parts)
    {
        return UriBuilder::build('users', $this->username, ...$parts);
    }
}
