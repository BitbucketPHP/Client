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

use Bitbucket\Api\User\Followers;
use Bitbucket\Api\User\Following;
use Bitbucket\Api\User\Hooks;
use Bitbucket\Api\User\PipelinesConfig;
use Bitbucket\Api\User\Repositories as UserRepositories;
use Bitbucket\Api\User\SshKeys;
use Http\Client\Common\HttpMethodsClient;

/**
 * The users api class.
 *
 * @author Graham Campbell <graham@alt-thre.com>
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
     * @return \Bitbucket\Api\User\Followers
     */
    public function followers()
    {
        return new Followers($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\User\Following
     */
    public function following()
    {
        return new Following($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\User\Hooks
     */
    public function hooks()
    {
        return new Hooks($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\User\PipelinesConfig
     */
    public function pipelinesConfig()
    {
        return new PipelinesConfig($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\User\Repositories
     */
    public function repositories()
    {
        return new UserRepositories($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\User\SshKeys
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
