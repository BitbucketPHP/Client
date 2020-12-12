<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
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
 * @author Graham Campbell <graham@alt-three.com>
 */
class Attachments extends AbstractIssuesApi
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
        $uri = $this->buildAttachmentsUri();

        return $this->get($uri, $params);
    }

    /**
     * @param \Bitbucket\HttpClient\Message\FileResource $file
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function upload(FileResource $file)
    {
        $uri = $this->buildAttachmentsUri();
        $builder = (new MultipartStreamBuilder())->addResource($file->getName(), $file->getResource(), $file->getOptions());
        $headers = [ResponseMediator::CONTENT_TYPE_HEADER => \sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($uri, $builder->build(), $headers);
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
        $uri = $this->buildAttachmentsUri($filename);

        return $this->getAsResponse($uri, $params, ['Accept' => '*/*'])->getBody();
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
        $uri = $this->buildAttachmentsUri($filename);

        return $this->delete($uri, $params);
    }

    /**
     * Build the attachments URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildAttachmentsUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'issues', $this->issue, 'attachments', ...$parts);
    }
}
