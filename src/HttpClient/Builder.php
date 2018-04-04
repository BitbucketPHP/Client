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

use GrahamCampbell\CachePlugin\CachePlugin;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClientFactory;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\StreamFactoryDiscovery;
use Http\Message\RequestFactory;
use Http\Message\StreamFactory;
use Psr\Cache\CacheItemPoolInterface;

/**
 * The Bitbucket HTTP client builder class.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Graham Campbell <graham@alt-three.com>
 */
class Builder
{
    /**
     * The object that sends HTTP messages.
     *
     * @var \Http\Client\HttpClient
     */
    private $httpClient;

    /**
     * A HTTP client with all our plugins.
     *
     * @var \Http\Client\Common\HttpMethodsClient
     */
    private $pluginClient;

    /**
     * The HTTP request factory.
     *
     * @var \Http\Message\MessageFactory
     */
    private $requestFactory;

    /**
     * The HTTP stream factory.
     *
     * @var \Http\Message\StreamFactory
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
     * This plugin is special treated because it has to be the very last plugin.
     *
     * @var \GrahamCampbell\CachePlugin\CachePlugin
     */
    private $cachePlugin;

    /**
     * Create a new http client builder instance.
     *
     * @param \Http\Client\HttpClient|null      $httpClient
     * @param \Http\Message\RequestFactory|null $requestFactory
     * @param \Http\Message\StreamFactory|null  $streamFactory
     */
    public function __construct(
        HttpClient $httpClient = null,
        RequestFactory $requestFactory = null,
        StreamFactory $streamFactory = null
    ) {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
        $this->streamFactory = $streamFactory ?: StreamFactoryDiscovery::find();
    }

    /**
     * @return \Http\Client\Common\HttpMethodsClient
     */
    public function getHttpClient()
    {
        if ($this->httpClientModified) {
            $this->httpClientModified = false;

            $plugins = $this->plugins;
            if ($this->cachePlugin) {
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
        $this->cachePlugin = new CachePlugin(
            $cachePool,
            $this->streamFactory,
            $config['generator'] ?? null,
            $config['lifetime'] ?? null
        );

        $this->httpClientModified = true;
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
