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

namespace Bitbucket\HttpClient;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\Cache\Generator\CacheKeyGenerator;
use Http\Client\Common\Plugin\Cache\Generator\HeaderCacheKeyGenerator;
use Http\Client\Common\Plugin\CachePlugin;
use Http\Client\Common\PluginClientFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;

/**
 * The Bitbucket HTTP client builder class.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
final class Builder
{
    /**
     * The default cache lifetime of 48 hours.
     *
     * @var int
     */
    const DEFAULT_CACHE_LIFETIME = 172800;

    /**
     * The object that sends HTTP messages.
     *
     * @var \Psr\Http\Client\ClientInterface
     */
    private $httpClient;

    /**
     * A HTTP client with all our plugins.
     *
     * @var \Http\Client\Common\HttpMethodsClientInterface
     */
    private $pluginClient;

    /**
     * The HTTP request factory.
     *
     * @var \Psr\Http\Message\RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * The HTTP stream factory.
     *
     * @var \Psr\Http\Message\StreamFactoryInterface
     */
    private $streamFactory;

    /**
     * True if we should create a new Plugin client at next request.
     *
     * @var bool
     */
    private $httpClientModified = true;

    /**
     * The currently registered plugins.
     *
     * @var \Http\Client\Common\Plugin[]
     */
    private $plugins = [];

    /**
     * The cache plugin to use.
     *
     * This plugin is specially treated because it has to be the very last plugin.
     *
     * @var \Http\Client\Common\Plugin\CachePlugin|null
     */
    private $cachePlugin;

    /**
     * Create a new http client builder instance.
     *
     * @param \Psr\Http\Client\ClientInterface|null          $httpClient
     * @param \Psr\Http\Message\RequestFactoryInterface|null $requestFactory
     * @param \Psr\Http\Message\StreamFactoryInterface|null  $streamFactory
     */
    public function __construct(
        ClientInterface $httpClient = null,
        RequestFactoryInterface $requestFactory = null,
        StreamFactoryInterface $streamFactory = null
    ) {
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
    }

    /**
     * @return \Http\Client\Common\HttpMethodsClientInterface
     */
    public function getHttpClient()
    {
        if ($this->httpClientModified) {
            $this->httpClientModified = false;

            $plugins = $this->plugins;
            if ($this->cachePlugin !== null) {
                $plugins[] = $this->cachePlugin;
            }

            $this->pluginClient = new HttpMethodsClient(
                (new PluginClientFactory())->createClient($this->httpClient, $plugins),
                $this->requestFactory
            );
        }

        return $this->pluginClient;
    }

    /**
     * Add a new plugin to the end of the plugin chain.
     *
     * @param \Http\Client\Common\Plugin $plugin
     *
     * @return void
     */
    public function addPlugin(Plugin $plugin)
    {
        $this->plugins[] = $plugin;
        $this->httpClientModified = true;
    }

    /**
     * Remove a plugin by its fully qualified class name (FQCN).
     *
     * @param string $fqcn
     *
     * @return void
     */
    public function removePlugin(string $fqcn)
    {
        foreach ($this->plugins as $idx => $plugin) {
            if ($plugin instanceof $fqcn) {
                unset($this->plugins[$idx]);
                $this->httpClientModified = true;
            }
        }
    }

    /**
     * Add a cache plugin to cache responses locally.
     *
     * @param \Psr\Cache\CacheItemPoolInterface $cachePool
     * @param array                             $config
     *
     * @return void
     */
    public function addCache(CacheItemPoolInterface $cachePool, array $config = [])
    {
        $this->setCachePlugin(
            $cachePool,
            $config['generator'] ?? new HeaderCacheKeyGenerator(['Authorization', 'Cookie', 'Accept', 'Content-type']),
            $config['lifetime'] ?? self::DEFAULT_CACHE_LIFETIME
        );

        $this->httpClientModified = true;
    }

    /**
     * Add a cache plugin to cache responses locally.
     *
     * @param \Psr\Cache\CacheItemPoolInterface                            $cachePool
     * @param \Http\Client\Common\Plugin\Cache\Generator\CacheKeyGenerator $generator
     * @param int                                                          $lifetime
     *
     * @return void
     */
    private function setCachePlugin(CacheItemPoolInterface $cachePool, CacheKeyGenerator $generator, int $lifetime)
    {
        $options = ['cache_lifetime' => $lifetime, 'cache_key_generator' => $generator];

        $this->cachePlugin = CachePlugin::clientCache($cachePool, $this->streamFactory, $options);
    }

    /**
     * Remove the cache plugin.
     *
     * @return void
     */
    public function removeCache()
    {
        $this->cachePlugin = null;
        $this->httpClientModified = true;
    }
}
