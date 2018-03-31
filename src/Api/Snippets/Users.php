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

use Bitbucket\Api\Snippets\Users\Comments;
use Bitbucket\Api\Snippets\Users\Commits;
use Bitbucket\Api\Snippets\Users\Diffs;
use Bitbucket\Api\Snippets\Users\Files;
use Bitbucket\Api\Snippets\Users\Patches;
use Bitbucket\Api\Snippets\Users\Watchers;
use Bitbucket\Api\Snippets\Users\Watching;
use Bitbucket\HttpClient\Message\FileResource;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The users api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Users extends AbstractSnippetsApi
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
        $path = $this->buildUsersPath();

        return $this->get($path, $params);
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
        $path = $this->buildUsersPath();
        $builder = (new MultipartStreamBuilder())->addResource($file->getName(), $file->getResource(), $file->getOptions());
        $headers = ['Content-Type' => sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($path, $builder->build(), $headers);
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
        $path = $this->buildUsersPath($snippet);

        return $this->get($path, $params);
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
        $path = $this->buildUsersPath($snippet);

        return $this->post($path, $params);
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
        $path = $this->buildUsersPath($snippet);

        $builder = new MultipartStreamBuilder();

        foreach ($files as $file) {
            $builder->addResource($file->getName(), $file->getResource(), $file->getOptions());
        }

        $headers = ['Content-Type' => sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($path, $builder->build(), $headers);
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
        $path = $this->buildUsersPath($snippet);

        return $this->delete($path, $params);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Users\Comments
     */
    public function comments(string $snippet)
    {
        return new Comments($this->getHttpClient(), $this->username, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Users\Commits
     */
    public function commits(string $snippet)
    {
        return new Commits($this->getHttpClient(), $this->username, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Users\Diffs
     */
    public function diffs(string $snippet)
    {
        return new Diffs($this->getHttpClient(), $this->username, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Users\Files
     */
    public function files(string $snippet)
    {
        return new Files($this->getHttpClient(), $this->username, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Users\Patches
     */
    public function patches(string $snippet)
    {
        return new Patches($this->getHttpClient(), $this->username, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Users\Watchers
     */
    public function watchers(string $snippet)
    {
        return new Watchers($this->getHttpClient(), $this->username, $snippet);
    }

    /**
     * @param string $snippet
     *
     * @return \Bitbucket\Api\Snippets\Users\Watching
     */
    public function watching(string $snippet)
    {
        return new Watching($this->getHttpClient(), $this->username, $snippet);
    }

    /**
     * Build the users path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildUsersPath(string ...$parts)
    {
        return static::buildPath('snippets', $this->username, ...$parts);
    }
}
