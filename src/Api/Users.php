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

use Bitbucket\Api\Users\Followers;
use Bitbucket\Api\Users\Following;
use Bitbucket\Api\Users\Hooks;
use Bitbucket\Api\Users\PipelinesConfig;
use Bitbucket\Api\Users\Repositories as UsersRepositories;
use Bitbucket\Api\Users\SshKeys;
use Http\Client\Common\HttpMethodsClient;

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
     * @param \Http\Client\Common\HttpMethodsClient $client
     * @param string                                $username
     */
    public function __construct(HttpMethodsClient $client, string $username)
    {
        parent::__construct($client);
        $this->username = $username;
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(array $params = [])
    {
        $path = $this->buildUsersPath();

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function codeSearch(array $params = [])
    {
        $path = $this->buildUsersPath('search', 'code');

        return $this->get($path, $params);
    }

    /**
     * @return \Bitbucket\Api\Users\Followers
     */
    public function followers()
    {
        return new Followers($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Users\Following
     */
    public function following()
    {
        return new Following($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Users\Hooks
     */
    public function hooks()
    {
        return new Hooks($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Users\PipelinesConfig
     */
    public function pipelinesConfig()
    {
        return new PipelinesConfig($this->getHttpClient(), $this->username);
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
     * @param string[] $parts
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
