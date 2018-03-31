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

namespace Bitbucket\HttpClient\Message;

/**
 * This is the file resource class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
final class FileResource
{
    /**
     * The name.
     *
     * @var string
     */
    private $name;

    /**
     * The resource.
     *
     * @var string|resource|\Psr\Http\Message\StreamInterface
     */
    private $resource;

    /**
     * The options.
     *
     * @var array
     */
    private $options;

    /**
     * Create a new file resource instance.
     *
     * @param string                                            $name
     * @param string|resource|\Psr\Http\Message\StreamInterface $resource
     * @param array                                             $options
     *
     * @return void
     */
    public function __construct(string $name, $resource, array $options = [])
    {
        $this->name = $name;
        $this->resource = $resource;
        $this->options = $options;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the resource.
     *
     * @return string|resource|\Psr\Http\Message\StreamInterface
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Get the options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}
