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
use Http\Client\Common\HttpMethodsClientInterface;

/**
 * The users api class.
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
     * Create a new users api instance.
     *
     * @param \Http\Client\Common\HttpMethodsClientInterface $client
     * @param string                                         $username
     */
    public function __construct(HttpMethodsClientInterface $client, string $username)
    {
        parent::__construct($client);
        $this->username = $username;
    }

    /**
     * @return \Bitbucket\Api\Users\Properties
     */
    public function properties()
    {
        return new Properties($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Users\Repositories
     */
    public function repositories()
    {
        return new UsersRepositories($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Users\SshKeys
     */
    public function sshKeys()
    {
        return new SshKeys($this->getHttpClient(), $this->username);
    }

    /**
     * Build the users path from the given parts.
     *
     * @param string ...$parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildUsersPath(string ...$parts)
    {
        return static::buildPath('users', $this->username, ...$parts);
    }
}
