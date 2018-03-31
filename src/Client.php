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

use Bitbucket\Exception\BadMethodCallException;
use Bitbucket\Exception\InvalidArgumentException;
use Bitbucket\HttpClient\Builder;
use Bitbucket\HttpClient\Plugin\Authentication;
use Bitbucket\HttpClient\Plugin\ExceptionThrower;
use Bitbucket\HttpClient\Plugin\History;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\HistoryPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\UriFactoryDiscovery;
use Psr\Cache\CacheItemPoolInterface;

/**
 * The Bitbucket API 2.0 client.
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
class Client
{
    /**
     * The http password authentication method.
     *
     * @var string
     */
    const AUTH_HTTP_PASSWORD = 'http_password';

    /**
     * The oauth token authentication method.
     *
     * @var string
     */
    const AUTH_OAUTH_TOKEN = 'oauth_token';

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
        $builder->addPlugin(new AddHostPlugin(UriFactoryDiscovery::find()->createUri('https://bitbucket.org/api/2.0')));
        $builder->addPlugin(new HeaderDefaultsPlugin(['User-Agent' => 'bitbucket-api-client/1.0']));

        $builder->addHeaderValue('Accept', 'application/json');
    }

    /**
     * Get a named api instance.
     *
     * @param string $name
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return \Bitbucket\Api\ApiInterface
     */
    public function api(string $name)
    {
        // TODO
        throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
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
     * Add a cache plugin to cache responses locally.
     *
     * @param \Psr\Cache\CacheItemPoolInterface $cache
     * @param array                             $config
     *
     * @return void
     */
    public function addCache(CacheItemPoolInterface $cachePool, array $config = [])
    {
        $this->getHttpClientBuilder()->addCache($cachePool, $config);
    }

    /**
     * Remove the cache plugin.
     *
     * @return void
     */
    public function removeCache()
    {
        $this->getHttpClientBuilder()->removeCache();
    }

    /**
     * Dynamically get a named api instance.
     *
     * @param string $name
     * @param array  $parameters
     *
     * @throws \Bitbucket\Exception\BadMethodCallException
     *
     * @return \Bitbucket\Api\ApiInterface
     */
    public function __call(string $method, array $parameters)
    {
        try {
            return $this->api($method);
        } catch (InvalidArgumentException $e) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $method));
        }
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
