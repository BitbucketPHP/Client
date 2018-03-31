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

use Bitbucket\Api\Teams\Followers;
use Bitbucket\Api\Teams\Following;
use Bitbucket\Api\Teams\Hooks;
use Bitbucket\Api\Teams\Members;
use Bitbucket\Api\Teams\Permissions;
use Bitbucket\Api\Teams\PipelinesConfig;
use Bitbucket\Api\Teams\Projects;
use Bitbucket\Api\Teams\Repositories as TeamsRepositories;
use Http\Client\Common\HttpMethodsClient;

/**
 * The teams api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Teams extends AbstractApi
{
    /**
     * The username.
     *
     * @var string
     */
    protected $username;

    /**
     * Create a new teams api instance.
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
        $path = $this->buildTeamsPath();

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
        $path = $this->buildTeamsPath('search', 'code');

        return $this->get($path, $params);
    }

    /**
     * @return \Bitbucket\Api\Teams\Followers
     */
    public function followers()
    {
        return new Followers($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Teams\Following
     */
    public function following()
    {
        return new Following($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Teams\Hooks
     */
    public function hooks()
    {
        return new Hooks($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Teams\Members
     */
    public function members()
    {
        return new Members($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Teams\Permissions
     */
    public function permissions()
    {
        return new Permissions($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Teams\PipelinesConfig
     */
    public function pipelinesConfig()
    {
        return new PipelinesConfig($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Teams\Projects
     */
    public function projects()
    {
        return new Projects($this->getHttpClient(), $this->username);
    }

    /**
     * @return \Bitbucket\Api\Teams\Repositories
     */
    public function repositories()
    {
        return new TeamsRepositories($this->getHttpClient(), $this->username);
    }

    /**
     * Build the teams path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildTeamsPath(string ...$parts)
    {
        return static::buildPath('teams', $this->username, ...$parts);
    }
}
