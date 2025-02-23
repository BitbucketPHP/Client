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

namespace Bitbucket\Api\Snippets;

use Bitbucket\Api\Snippets\Workspaces\Comments;
use Bitbucket\Api\Snippets\Workspaces\Commits;
use Bitbucket\Api\Snippets\Workspaces\Diffs;
use Bitbucket\Api\Snippets\Workspaces\Files;
use Bitbucket\Api\Snippets\Workspaces\Patches;
use Bitbucket\Api\Snippets\Workspaces\Watchers;
use Bitbucket\Api\Snippets\Workspaces\Watching;
use Bitbucket\HttpClient\Message\FileResource;
use Bitbucket\HttpClient\Message\ResponseMediator;
use Bitbucket\HttpClient\Util\UriBuilder;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The workspaces API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Workspaces extends AbstractSnippetsApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildWorkspacesUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(FileResource $file): array
    {
        $uri = $this->buildWorkspacesUri();
        $builder = (new MultipartStreamBuilder())->addResource($file->getName(), $file->getResource(), $file->getOptions());
        $headers = [ResponseMediator::CONTENT_TYPE_HEADER => \sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($uri, $builder->build(), $headers);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $snippet, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($snippet);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $snippet, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($snippet);

        return $this->post($uri, $params);
    }

    /**
     * @param \Bitbucket\HttpClient\Message\FileResource[] $files
     *
     * @throws \Http\Client\Exception
     */
    public function updateFiles(string $snippet, array $files): array
    {
        $uri = $this->buildWorkspacesUri($snippet);

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
    public function remove(string $snippet, array $params = []): array
    {
        $uri = $this->buildWorkspacesUri($snippet);

        return $this->delete($uri, $params);
    }

    public function comments(string $snippet): Comments
    {
        return new Comments($this->getClient(), $this->workspace, $snippet);
    }

    public function commits(string $snippet): Commits
    {
        return new Commits($this->getClient(), $this->workspace, $snippet);
    }

    public function diffs(string $snippet): Diffs
    {
        return new Diffs($this->getClient(), $this->workspace, $snippet);
    }

    public function files(string $snippet): Files
    {
        return new Files($this->getClient(), $this->workspace, $snippet);
    }

    public function patches(string $snippet): Patches
    {
        return new Patches($this->getClient(), $this->workspace, $snippet);
    }

    public function watchers(string $snippet): Watchers
    {
        return new Watchers($this->getClient(), $this->workspace, $snippet);
    }

    public function watching(string $snippet): Watching
    {
        return new Watching($this->getClient(), $this->workspace, $snippet);
    }

    /**
     * Build the workspaces URI from the given parts.
     */
    protected function buildWorkspacesUri(string ...$parts): string
    {
        return UriBuilder::build('snippets', $this->workspace, ...$parts);
    }
}
