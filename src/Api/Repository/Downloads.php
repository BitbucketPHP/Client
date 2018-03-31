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

namespace Bitbucket\Api\Repository;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The downloads api class.
 *
 * @author Graham Campbell <graham@alt-thre.com>
 */
class Downloads extends AbstractRepositoryApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = [])
    {
        $path = $this->buildDownloadsPath();

        return $this->get($path, $params);
    }

    /**
     * @param string                                            $name
     * @param string|resource|\Psr\Http\Message\StreamInterface $resource
     * @param array                                             $options
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function upload(string $name, $resource, array $options = [])
    {
        $path = $this->buildDownloadsPath();
        $builder = (new MultipartStreamBuilder())->addResource($name, $resource, $options);
        $headers = ['Content-Type' => sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($path, $builder->build(), $headers);
    }

    /**
     * @param string $filename
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function download(string $filename, array $params = [])
    {
        $path = $this->buildDownloadsPath($filename);

        return $this->pureGet($path, $params, ['Accept' => '*/*'])->getBody();
    }

    /**
     * @param string $filename
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $filename, array $params = [])
    {
        $path = $this->buildDownloadsPath($filename);

        return $this->delete($path, $params, ['Accept' => '*/*']);
    }

    /**
     * Build the downloads path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildDownloadsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'downloads', ...$parts);
    }
}
