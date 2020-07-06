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

namespace Bitbucket\Api;

use Bitbucket\Api\Snippets\Workspaces as SnippetsWorkspaces;
use Bitbucket\HttpClient\Message\FileResource;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The snippets api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Snippets extends AbstractApi
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
        $uri = $this->buildSnippetsUri();

        return $this->get($uri, $params);
    }

    /**
     * @param \Bitbucket\HttpClient\Message\FileResource $file
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(FileResource $file)
    {
        $uri = $this->buildSnippetsUri();
        $builder = (new MultipartStreamBuilder())->addResource($file->getName(), $file->getResource(), $file->getOptions());
        $headers = ['Content-Type' => sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($uri, $builder->build(), $headers);
    }

    /**
     * @param string $workspace
     *
     * @return \Bitbucket\Api\Snippets\Workspaces
     */
    public function workspaces(string $workspace)
    {
        return new SnippetsWorkspaces($this->getHttpClient(), $workspace);
    }

    /**
     * Build the snippets URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildSnippetsUri(string ...$parts)
    {
        return UriBuilder::buildUri('snippets', ...$parts);
    }
}
