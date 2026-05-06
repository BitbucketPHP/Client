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

use Bitbucket\Api\AbstractApi;
use Bitbucket\Exception\RuntimeException;
use Bitbucket\HttpClient\Message\ResponseMediator;
use Closure;
use Generator;
use ValueError;

/**
 * This is the result pager class.
 *
 * @author Ramon de la Fuente <ramon@future500.nl>
 * @author Mitchel Verschoof <mitchel@future500.nl>
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
final class ResultPager implements ResultPagerInterface
{
    /**
     * The default number of entries to request per page.
     *
     * @var int
     */
    private const PER_PAGE = 50;

    private readonly Client $client;

    private readonly int $perPage;

    /**
     * @var array<string,string>
     */
    private array $pagination;

    public function __construct(Client $client, ?int $perPage = null)
    {
        if (null !== $perPage && ($perPage < 1 || $perPage > 50)) {
            throw new ValueError(\sprintf('%s::__construct(): Argument #2 ($perPage) must be between 1 and 50, or null', self::class));
        }

        $this->client = $client;
        $this->perPage = $perPage ?? self::PER_PAGE;
        $this->pagination = [];
    }

    /**
     * Fetch a single result from an api call.
     *
     * @throws \Http\Client\Exception
     */
    public function fetch(AbstractApi $api, string $method, array $parameters = []): array
    {
        /** @var mixed */
        $result = self::bindPerPage($api, $this->perPage)->$method(...$parameters);

        if (!\is_array($result)) {
            throw new RuntimeException('Pagination of this endpoint is not supported.');
        }

        $this->postFetch();

        return $result;
    }

    /**
     * Fetch all results from an api call.
     *
     * @throws \Http\Client\Exception
     */
    public function fetchAll(AbstractApi $api, string $method, array $parameters = []): array
    {
        return \iterator_to_array($this->fetchAllLazy($api, $method, $parameters));
    }

    /**
     * Lazily fetch all results from an api call.
     *
     * @throws \Http\Client\Exception
     */
    public function fetchAllLazy(AbstractApi $api, string $method, array $parameters = []): Generator
    {
        /** @var mixed $value */
        foreach (self::getValues($this->fetch($api, $method, $parameters)) as $value) {
            yield $value;
        }

        while ($this->hasNext()) {
            /** @var mixed $value */
            foreach (self::getValues($this->fetchNext()) as $value) {
                yield $value;
            }
        }
    }

    /**
     * Check to determine the availability of a next page.
     */
    public function hasNext(): bool
    {
        return isset($this->pagination['next']);
    }

    /**
     * Fetch the next page.
     *
     * @throws \Http\Client\Exception
     */
    public function fetchNext(): array
    {
        return $this->get('next');
    }

    /**
     * Check to determine the availability of a previous page.
     */
    public function hasPrevious(): bool
    {
        return isset($this->pagination['previous']);
    }

    /**
     * Fetch the previous page.
     *
     * @throws \Http\Client\Exception
     */
    public function fetchPrevious(): array
    {
        return $this->get('previous');
    }

    /**
     * Refresh the pagination property.
     */
    private function postFetch(): void
    {
        $response = $this->client->getLastResponse();

        $this->pagination = null === $response ? [] : ResponseMediator::getPagination($response);
    }

    /**
     * @throws \Http\Client\Exception
     */
    private function get(string $key): array
    {
        $pagination = $this->pagination[$key] ?? null;

        if (null === $pagination) {
            return [];
        }

        $result = $this->client->getHttpClient()->get($pagination);

        $content = ResponseMediator::getContent($result);

        $this->postFetch();

        return $content;
    }

    private static function bindPerPage(AbstractApi $api, int $perPage): AbstractApi
    {
        /** @var Closure(AbstractApi): AbstractApi */
        $closure = Closure::bind(static function (AbstractApi $api) use ($perPage): AbstractApi {
            $clone = clone $api;

            $clone->perPage = $perPage;

            return $clone;
        }, null, AbstractApi::class);

        return $closure($api);
    }

    /**
     * @throws \Bitbucket\Exception\RuntimeException
     */
    private static function getValues(array $result): array
    {
        if (!isset($result['values']) || !\is_array($result['values'])) {
            throw new RuntimeException('Pagination of this endpoint is not supported.');
        }

        return $result['values'];
    }
}
