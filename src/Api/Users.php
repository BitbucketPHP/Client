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

namespace Bitbucket\Api;

use Bitbucket\Api\Users\Properties;
use Bitbucket\Api\Users\Repositories as UsersRepositories;
use Bitbucket\Api\Users\SshKeys;
use Bitbucket\Client;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The users API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Users extends AbstractApi
{
    protected readonly string $username;

    public function __construct(Client $client, string $username)
    {
        parent::__construct($client);
        $this->username = $username;
    }

    public function properties(): Properties
    {
        return new Properties($this->getClient(), $this->username);
    }

    public function repositories(): UsersRepositories
    {
        return new UsersRepositories($this->getClient(), $this->username);
    }

    public function sshKeys(): SshKeys
    {
        return new SshKeys($this->getClient(), $this->username);
    }

    /**
     * Build the users URI from the given parts.
     */
    protected function buildUsersUri(string ...$parts): string
    {
        return UriBuilder::build('users', $this->username, ...$parts);
    }
}
