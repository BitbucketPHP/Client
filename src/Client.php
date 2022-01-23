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

namespace Bitbucket;

use Bitbucket\Api\Addon;
use Bitbucket\Api\CurrentUser;
use Bitbucket\Api\HookEvents;
use Bitbucket\Api\PullRequests;
use Bitbucket\Api\Repositories;
use Bitbucket\Api\Snippets;
use Bitbucket\Api\Users;
use Bitbucket\Api\Workspaces;
use Bitbucket\HttpClient\Builder;
use Bitbucket\HttpClient\Message\ResponseMediator;
use Bitbucket\HttpClient\Plugin\Authentication;
use Bitbucket\HttpClient\Plugin\ExceptionThrower;
use Bitbucket\HttpClient\Plugin\History;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\HistoryPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * The Bitbucket API 2.0 client.
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Client
{
    /**
     * The OAuth 2 token authentication method.
     *
     * @var string
     */
    public const AUTH_OAUTH_TOKEN = 'oauth_token';

    /**
     * The HTTP password authentication method.
     *
     * @var string
     */
    public const AUTH_HTTP_PASSWORD = 'http_password';

    /**
     * The JSON web token authentication method.
     *
     * @var string
     */
    public const AUTH_JWT = 'jwt';

    /**
     * The default base URL.
     *
     * @var string
     */
    private const BASE_URL = 'https://api.bitbucket.org';

    /**
     * The default user agent header.
     *
     * @var string
     */
    private const USER_AGENT = 'bitbucket-php-api-client/4.1';

    /**
     * The HTTP client builder.
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
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();
        $this->responseHistory = new History();

        $builder->addPlugin(new ExceptionThrower());
        $builder->addPlugin(new HistoryPlugin($this->responseHistory));
        $builder->addPlugin(new RedirectPlugin());

        $builder->addPlugin(new HeaderDefaultsPlugin([
            'Accept' => ResponseMediator::JSON_CONTENT_TYPE,
            'User-Agent' => self::USER_AGENT,
        ]));

        $this->setUrl(self::BASE_URL);
    }

    /**
     * Create a Bitbucket\Client using an HTTP client.
     *
     * @param \Psr\Http\Client\ClientInterface $httpClient
     *
     * @return Client
     */
    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);

        return new self($builder);
    }

    /**
     * @return \Bitbucket\Api\Addon
     */
    public function addon(): Addon
    {
        return new Addon($this);
    }

    /**
     * @return \Bitbucket\Api\CurrentUser
     */
    public function currentUser(): CurrentUser
    {
        return new CurrentUser($this);
    }

    /**
     * @return \Bitbucket\Api\HookEvents
     */
    public function hookEvents(): HookEvents
    {
        return new HookEvents($this);
    }

    /**
     * @return \Bitbucket\Api\PullRequests
     */
    public function pullRequests(): PullRequests
    {
        return new PullRequests($this);
    }

    /**
     * @return \Bitbucket\Api\Repositories
     */
    public function repositories(): Repositories
    {
        return new Repositories($this);
    }

    /**
     * @return \Bitbucket\Api\Snippets
     */
    public function snippets(): Snippets
    {
        return new Snippets($this);
    }

    /**
     * @param string $username
     *
     * @return \Bitbucket\Api\Users
     */
    public function users(string $username): Users
    {
        return new Users($this, $username);
    }

    /**
     * @param string $workspace
     *
     * @return \Bitbucket\Api\Workspaces
     */
    public function workspaces(string $workspace): Workspaces
    {
        return new Workspaces($this, $workspace);
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
    public function authenticate(string $method, string $token, string $password = null): void
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
    public function setUrl(string $url): void
    {
        $this->httpClientBuilder->removePlugin(AddHostPlugin::class);
        $this->httpClientBuilder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri($url)));
    }

    /**
     * Get the last response.
     *
     * @return \Psr\Http\Message\ResponseInterface|null
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->responseHistory->getLastResponse();
    }

    /**
     * Get the HTTP client.
     *
     * @return \Http\Client\Common\HttpMethodsClientInterface
     */
    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    /**
     * Get the HTTP client builder.
     *
     * @return \Bitbucket\HttpClient\Builder
     */
    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
