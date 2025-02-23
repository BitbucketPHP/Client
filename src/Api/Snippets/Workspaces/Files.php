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

namespace Bitbucket\Api\Snippets\Workspaces;

use Bitbucket\HttpClient\Message\ResponseMediator;
use Bitbucket\HttpClient\Util\UriBuilder;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The files API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Files extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $commit, array $params = []): array
    {
        $uri = $this->buildFilesUri($commit);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function download(string $commit, string $uri, array $params = []): \Psr\Http\Message\StreamInterface
    {
        $uri = $this->buildFilesUri($commit, 'files', ...\explode('/', $uri));

        return $this->getAsResponse($uri, $params, ['Accept' => '*/*'])->getBody();
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $commit, array $params = []): array
    {
        $uri = $this->buildFilesUri($commit);

        return $this->post($uri, $params);
    }

    /**
     * @param \Bitbucket\HttpClient\Message\FileResource[] $files
     *
     * @throws \Http\Client\Exception
     */
    public function updateFiles(string $commit, array $files): array
    {
        $uri = $this->buildFilesUri($commit);

        $builder = new MultipartStreamBuilder();

        foreach ($files as $file) {
            $builder->addResource($file->getName(), $file->getResource(), $file->getOptions());
        }

        $headers = [ResponseMediator::CONTENT_TYPE_HEADER => \sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($uri, $builder->build(), $headers);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $commit, array $params = []): array
    {
        $uri = $this->buildFilesUri($commit);

        return $this->delete($uri, $params);
    }

    /**
     * Build the files URI from the given parts.
     */
    protected function buildFilesUri(string ...$parts): string
    {
        return UriBuilder::build('snippets', $this->workspace, $this->snippet, ...$parts);
    }
}
