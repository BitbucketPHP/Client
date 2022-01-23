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

namespace Bitbucket\Api\Repositories\Workspaces;

use Bitbucket\HttpClient\Message\ResponseMediator;
use Bitbucket\HttpClient\Util\UriBuilder;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The src API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
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
     * @param array<string,string> $params
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
     * @param array<string,string>                         $params
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
            if ('' === $file->getResource()) {
                $builder->addResource('files', $file->getName());
            } else {
                $builder->addResource($file->getName(), $file->getResource(), $file->getOptions());
            }
        }

        $headers = [ResponseMediator::CONTENT_TYPE_HEADER => \sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

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

        return $this->getAsResponse($uri, $params, ['Accept' => '*/*'])->getBody();
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
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'src', ...$parts);
    }
}
