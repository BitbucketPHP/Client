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

use Bitbucket\HttpClient\Message\FileResource;
use Bitbucket\HttpClient\Message\ResponseMediator;
use Bitbucket\HttpClient\Util\UriBuilder;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The downloads API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Downloads extends AbstractWorkspacesApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildDownloadsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function upload(FileResource $file): array
    {
        $uri = $this->buildDownloadsUri();
        $builder = (new MultipartStreamBuilder())->addResource($file->getName(), $file->getResource(), $file->getOptions());
        $headers = [ResponseMediator::CONTENT_TYPE_HEADER => \sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($uri, $builder->build(), $headers);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function download(string $filename, array $params = []): \Psr\Http\Message\StreamInterface
    {
        $uri = $this->buildDownloadsUri(...\explode('/', $filename));

        return $this->getAsResponse($uri, $params, ['Accept' => '*/*'])->getBody();
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $filename, array $params = []): array
    {
        $uri = $this->buildDownloadsUri(...\explode('/', $filename));

        return $this->delete($uri, $params);
    }

    /**
     * Build the downloads URI from the given parts.
     */
    protected function buildDownloadsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'downloads', ...$parts);
    }
}
