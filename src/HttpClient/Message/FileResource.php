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

namespace Bitbucket\HttpClient\Message;

use Psr\Http\Message\StreamInterface;

/**
 * This is the file resource class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
final class FileResource
{
    /**
     * Create a new file resource instance.
     *
     * @param string|resource|StreamInterface $resource
     *
     * @return void
     */
    public function __construct(
        private readonly string $name,
        private readonly mixed $resource,
        private readonly array $options = [],
    ) {
    }

    /**
     * Get the name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the resource.
     *
     * @return string|resource|StreamInterface
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Get the options.
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
