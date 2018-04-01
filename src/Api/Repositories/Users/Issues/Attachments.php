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

namespace Bitbucket\Api\Repositories\Users\Issues;

use Bitbucket\HttpClient\Message\FileResource;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The attachments api class.
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
        $path = $this->buildAttachmentsPath();

        return $this->get($path, $params);
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
        $path = $this->buildAttachmentsPath();
        $builder = (new MultipartStreamBuilder())->addResource($file->getName(), $file->getResource(), $file->getOptions());
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
        $path = $this->buildAttachmentsPath($filename);

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
        $path = $this->buildAttachmentsPath($filename);

        return $this->delete($path, $params);
    }

    /**
     * Build the attachments path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildAttachmentsPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, $this->repo, 'issues', $this->issue, 'attachments', ...$parts);
    }
}
