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

namespace Bitbucket\Api;

use Bitbucket\Api\Snippets\Workspaces as SnippetsWorkspaces;
use Bitbucket\HttpClient\Message\FileResource;
use Bitbucket\HttpClient\Message\ResponseMediator;
use Bitbucket\HttpClient\Util\UriBuilder;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * The snippets API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Snippets extends AbstractApi
{
    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = []): array
    {
        $uri = $this->buildSnippetsUri();

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(FileResource $file): array
    {
        $uri = $this->buildSnippetsUri();
        $builder = (new MultipartStreamBuilder())->addResource($file->getName(), $file->getResource(), $file->getOptions());
        $headers = [ResponseMediator::CONTENT_TYPE_HEADER => \sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        return $this->postRaw($uri, $builder->build(), $headers);
    }

    /**
     * @return \Bitbucket\Api\Snippets\Workspaces
     */
    public function workspaces(string $workspace): \Bitbucket\Api\Snippets\Workspaces
    {
        return new SnippetsWorkspaces($this->getClient(), $workspace);
    }

    /**
     * Build the snippets URI from the given parts.
     *
     * @return string
     */
    protected function buildSnippetsUri(string ...$parts): string
    {
        return UriBuilder::build('snippets', ...$parts);
    }
}
