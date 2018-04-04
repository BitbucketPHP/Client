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

namespace Bitbucket;

use Bitbucket\Api\Addon;
use Bitbucket\Api\CurrentUser;
use Bitbucket\Api\HookEvents;
use Bitbucket\Api\Repositories;
use Bitbucket\Api\Snippets;
use Bitbucket\Api\Teams;
use Bitbucket\Api\Users;
use Bitbucket\HttpClient\Builder;
use Bitbucket\HttpClient\Plugin\Authentication;
use Bitbucket\HttpClient\Plugin\ExceptionThrower;
use Bitbucket\HttpClient\Plugin\History;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\HistoryPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\UriFactoryDiscovery;

/**
 * The Bitbucket API 2.0 client.
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
class Client
{
    /**
     * The oauth token authentication method.
     *
     * @var string
     */
    const AUTH_OAUTH_TOKEN = 'oauth_token';

    /**
     * The http password authentication method.
     *
     * @var string
     */
    const AUTH_HTTP_PASSWORD = 'http_password';

    /**
     * The bitbucket http client builder.
     *
     * @var \Bitbucket\HttpClient\Builder
     */
    private $httpClientBuilder;

    /**
     * The response history plugin.
     *
     * @var \Bitbucket\HttpClient\Plugin\History
     */
    private $responseHistory;

    /**
     * Create a new Bitbucket API client instance.
     *
     * @param \Bitbucket\HttpClient\Builder|null $httpClientBuilder
     *
     * @return void
     */
    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?: new Builder();
        $this->responseHistory = new History();

        $builder->addPlugin(new ExceptionThrower());
        $builder->addPlugin(new HistoryPlugin($this->responseHistory));
        $builder->addPlugin(new RedirectPlugin());

        $builder->addPlugin(new HeaderDefaultsPlugin([
            'Accept'     => 'application/json',
            'User-Agent' => 'bitbucket-api-client/1.1',
        ]));

        $this->setUrl('https://api.bitbucket.org');
    }

    /**
     * @return \Bitbucket\Api\Addon
     */
    public function addon()
    {
        return new Addon($this->getHttpClient());
    }

    /**
     * @return \Bitbucket\Api\CurrentUser
     */
    public function currentUser()
    {
        return new CurrentUser($this->getHttpClient());
    }

    /**
     * @return \Bitbucket\Api\HookEvents
     */
    public function hookEvents()
    {
        return new HookEvents($this->getHttpClient());
    }

    /**
     * @return \Bitbucket\Api\Repositories
     */
    public function repositories()
    {
        return new Repositories($this->getHttpClient());
    }

    /**
     * @return \Bitbucket\Api\Snippets
     */
    public function snippets()
    {
        return new Snippets($this->getHttpClient());
    }

    /**
     * @param string $username
     *
     * @return \Bitbucket\Api\Teams
     */
    public function teams(string $username)
    {
        return new Teams($this->getHttpClient(), $username);
    }

    /**
     * @param string $username
     *
     * @return \Bitbucket\Api\Users
     */
    public function users(string $username)
    {
        return new Users($this->getHttpClient(), $username);
    }

    /**
     * Authenticate a user for all next requests.
     *
     * @param string      $method
     * @param string      $token
     * @param string|null $password
     *
     * @return void
     */
    public function authenticate(string $method, string $token, string $password = null)
    {
        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(new Authentication($method, $token, $password));
    }

    /**
     * Set the base URL.
     *
     * @param string $url
     *
     * @return void
     */
    public function setUrl(string $url)
    {
        $this->httpClientBuilder->removePlugin(AddHostPlugin::class);
        $this->httpClientBuilder->addPlugin(new AddHostPlugin(UriFactoryDiscovery::find()->createUri($url)));
    }

    /**
     * Get the last response.
     *
     * @return \Psr\Http\Message\ResponseInterface|null
     */
    public function getLastResponse()
    {
        return $this->responseHistory->getLastResponse();
    }

    /**
     * Get the http client.
     *
     * @return \Http\Client\Common\HttpMethodsClient
     */
    public function getHttpClient()
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    /**
     * Get the http client builder.
     *
     * @return \Bitbucket\HttpClient\Builder
     */
    protected function getHttpClientBuilder()
    {
        return $this->httpClientBuilder;
    }
}
