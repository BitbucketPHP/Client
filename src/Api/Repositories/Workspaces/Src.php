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

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\HttpClient\Util\UriBuilder;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The src api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Src extends AbstractWorkspacesApi
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
        $uri = $this->buildSrcUri();

        return $this->get($uri, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $uri = $this->buildSrcUri();

        return $this->post($uri, $params);
    }

    /**
     * @param \Bitbucket\HttpClient\Message\FileResource[] $files
     * @param array                                        $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function createWithFiles(array $files, array $params = [])
    {
        $uri = $this->buildSrcUri();

        $builder = new MultipartStreamBuilder();

        foreach ($params as $name => $value) {
            $builder->addResource($name, $value);
        }

        foreach ($files as $file) {
            if ($file->getResource() === '') {
                $builder->addResource('files', $file->getName());
            } else {
                $builder->addResource($file->getName(), $file->getResource(), $file->getOptions());
            }
        }

        $headers = ['Content-Type' => sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($uri, $builder->build(), $headers);
    }

    /**
     * @param string $commit
     * @param string $filepath
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $commit, string $filepath, array $params = [])
    {
        $uri = $this->buildSrcUri($commit, $filepath);

        if (!isset($params['format'])) {
            $params['format'] = 'meta';
        }

        return $this->get($uri, $params);
    }

    /**
     * @param string $commit
     * @param string $filepath
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function download(string $commit, string $filepath, array $params = [])
    {
        $uri = $this->buildSrcUri($commit, $filepath);

        return $this->pureGet($uri, $params, ['Accept' => '*/*'])->getBody();
    }

    /**
     * Build the src URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildSrcUri(string ...$parts)
    {
        return UriBuilder::buildUri('repositories', $this->workspace, $this->repo, 'src', ...$parts);
    }
}
