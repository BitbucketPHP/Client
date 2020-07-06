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

namespace Bitbucket\Api\Snippets;

use Bitbucket\Api\Snippets\Workspaces\Comments;
use Bitbucket\Api\Snippets\Workspaces\Commits;
use Bitbucket\Api\Snippets\Workspaces\Diffs;
use Bitbucket\Api\Snippets\Workspaces\Files;
use Bitbucket\Api\Snippets\Workspaces\Patches;
use Bitbucket\Api\Snippets\Workspaces\Watchers;
use Bitbucket\Api\Snippets\Workspaces\Watching;
use Bitbucket\HttpClient\Message\FileResource;
use Bitbucket\HttpClient\Util\UriBuilder;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The workspaces api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Workspaces extends AbstractSnippetsApi
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
        $uri = $this->buildWorkspacesUri();

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
        $uri = $this->buildWorkspacesUri();
        $builder = (new MultipartStreamBuilder())->addResource($file->getName(), $file->getResource(), $file->getOptions());
        $headers = ['Content-Type' => sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($uri, $builder->build(), $headers);
    }

    /**
     * @param string $snippet
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $snippet, array $params = [])
    {
        $uri = $this->buildWorkspacesUri($snippet);

        return $this->get($uri, $params);
    }

    /**
     * @param string $snippet
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $snippet, array $params = [])
    {
        $uri = $this->buildWorkspacesUri($snippet);

        return $this->post($uri, $params);
    }

    /**
     * @param string                                       $snippet
     * @param \Bitbucket\HttpClient\Message\FileResource[] $files
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function updateFiles(string $snippet, array $files)
    {
        $uri = $this->buildWorkspacesUri($snippet);

        $builder = new MultipartStreamBuilder();

        foreach ($files as $file) {
            $builder->addResource($file->getName(), $file->getResource(), $file->getOptions());
        }

        $headers = ['Content-Type' => sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($uri, $builder->build(), $headers);
    }

    /**
     * @param string $snippet
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $snippet, array $params = [])
    {
        $uri = $this->buildWorkspacesUri($snippet);

        return $this->delete($uri, $params);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Workspaces\Comments
     */
    public function comments(string $snippet)
    {
        return new Comments($this->getHttpClient(), $this->workspace, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Workspaces\Commits
     */
    public function commits(string $snippet)
    {
        return new Commits($this->getHttpClient(), $this->workspace, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Workspaces\Diffs
     */
    public function diffs(string $snippet)
    {
        return new Diffs($this->getHttpClient(), $this->workspace, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Workspaces\Files
     */
    public function files(string $snippet)
    {
        return new Files($this->getHttpClient(), $this->workspace, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Workspaces\Patches
     */
    public function patches(string $snippet)
    {
        return new Patches($this->getHttpClient(), $this->workspace, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Workspaces\Watchers
     */
    public function watchers(string $snippet)
    {
        return new Watchers($this->getHttpClient(), $this->workspace, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Workspaces\Watching
     */
    public function watching(string $snippet)
    {
        return new Watching($this->getHttpClient(), $this->workspace, $snippet);
    }

    /**
     * Build the workspaces URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    protected function buildWorkspacesUri(string ...$parts)
    {
        return UriBuilder::buildUri('snippets', $this->workspace, ...$parts);
    }
}
