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
    private const USER_AGENT = 'bitbucket-php-api-client/5.1';

    private readonly Builder $httpClientBuilder;
    private readonly History $responseHistory;

    public function __construct(?Builder $httpClientBuilder = null)
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
     */
    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);

        return new self($builder);
    }

    public function addon(): Addon
    {
        return new Addon($this);
    }

    public function currentUser(): CurrentUser
    {
        return new CurrentUser($this);
    }

    public function hookEvents(): HookEvents
    {
        return new HookEvents($this);
    }

    public function pullRequests(): PullRequests
    {
        return new PullRequests($this);
    }

    public function repositories(): Repositories
    {
        return new Repositories($this);
    }

    public function snippets(): Snippets
    {
        return new Snippets($this);
    }

    public function users(string $username): Users
    {
        return new Users($this, $username);
    }

    public function workspaces(string $workspace): Workspaces
    {
        return new Workspaces($this, $workspace);
    }

    /**
     * Authenticate a user for all next requests.
     */
    public function authenticate(string $method, #[\SensitiveParameter] string $token, #[\SensitiveParameter] ?string $password = null): void
    {
        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(new Authentication($method, $token, $password));
    }

    /**
     * Set the base URL.
     */
    public function setUrl(string $url): void
    {
        $this->httpClientBuilder->removePlugin(AddHostPlugin::class);
        $this->httpClientBuilder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri($url)));
    }

    /**
     * Get the last response.
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->responseHistory->getLastResponse();
    }

    /**
     * Get the HTTP client.
     */
    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    /**
     * Get the HTTP client builder.
     */
    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
