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

namespace Bitbucket\Api\Repositories\Workspaces\Issues;

use Bitbucket\HttpClient\Message\FileResource;
use Bitbucket\HttpClient\Message\ResponseMediator;
use Bitbucket\HttpClient\Util\UriBuilder;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The attachments API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Attachments extends AbstractIssuesApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildAttachmentsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function upload(FileResource $file): array
    {
        $uri = $this->buildAttachmentsUri();
        $builder = (new MultipartStreamBuilder())->addResource($file->getName(), $file->getResource(), $file->getOptions());
        $headers = [ResponseMediator::CONTENT_TYPE_HEADER => \sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($uri, $builder->build(), $headers);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function download(string $filename, array $params = []): \Psr\Http\Message\StreamInterface
    {
        $uri = $this->buildAttachmentsUri($filename);

        return $this->getAsResponse($uri, $params, ['Accept' => '*/*'])->getBody();
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @deprecated bitbucket has deprecated native issue tracker APIs
     */
    public function remove(string $filename, array $params = []): array
    {
        $uri = $this->buildAttachmentsUri($filename);

        return $this->delete($uri, $params);
    }

    /**
     * Build the attachments URI from the given parts.
     */
    protected function buildAttachmentsUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'issues', $this->issue, 'attachments', ...$parts);
    }
}
