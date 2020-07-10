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

namespace Bitbucket\Api\Snippets\Workspaces;

use Bitbucket\HttpClient\Util\UriBuilder;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The files api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Files extends AbstractWorkspacesApi
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
        $uri = $this->buildFilesUri($commit);

        return $this->get($uri, $params);
    }

    /**
     * @param string $commit
     * @param string $uri
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function download(string $commit, string $uri, array $params = [])
    {
        $uri = $this->buildFilesUri($commit, 'files', ...explode('/', $uri));

        return $this->getAsResponse($uri, $params, ['Accept' => '*/*'])->getBody();
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
        $uri = $this->buildFilesUri($commit);

        return $this->post($uri, $params);
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
        $uri = $this->buildFilesUri($commit);

        $builder = new MultipartStreamBuilder();

        foreach ($files as $file) {
            $builder->addResource($file->getName(), $file->getResource(), $file->getOptions());
        }

        $headers = ['Content-Type' => sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($uri, $builder->build(), $headers);
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
        $uri = $this->buildFilesUri($commit);

        return $this->delete($uri, $params);
    }

    /**
     * Build the files URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildFilesUri(string ...$parts)
    {
        return UriBuilder::build('snippets', $this->workspace, $this->snippet, ...$parts);
    }
}
