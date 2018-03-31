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

namespace Bitbucket\Api\Snippets\Users;

use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The files api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Files extends AbstractUsersApi
{
    /**
     * @param string $commit
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $commit, array $params = [])
    {
        $path = $this->buildFilesPath($commit);

        return $this->get($path, $params);
    }

    /**
     * @param string $commit
     * @param string $path
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function download(string $commit, string $path, array $params = [])
    {
        $path = $this->buildFilesPath($commit, 'files', ...explode('/', $path));

        return $this->pureGet($path, $params, ['Accept' => '*/*'])->getBody();
    }

    /**
     * @param string $commit
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $commit, array $params = [])
    {
        $path = $this->buildFilesPath($commit);

        return $this->post($path, $params);
    }

    /**
     * @param string                                       $commit
     * @param \Bitbucket\HttpClient\Message\FileResource[] $files
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function updateFiles(string $commit, array $files)
    {
        $path = $this->buildFilesPath($commit);

        $builder = new MultipartStreamBuilder();

        foreach ($files as $file) {
            $builder->addResource($file->getName(), $file->getResource(), $file->getOptions());
        }

        $headers = ['Content-Type' => sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($path, $builder->build(), $headers);
    }

    /**
     * @param string $commit
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $commit, array $params = [])
    {
        $path = $this->buildFilesPath($commit);

        return $this->delete($path, $params);
    }

    /**
     * Build the files path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildFilesPath(string ...$parts)
    {
        return static::buildPath('snippets', $this->username, $this->snippet, ...$parts);
    }
}
