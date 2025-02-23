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

namespace Bitbucket\Api\Workspaces\PipelinesConfig;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The variables API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class Variables extends AbstractPipelinesConfigApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildVariablesUri());

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildVariablesUri());

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $variable, array $params = []): array
    {
        $uri = $this->buildVariablesUri($variable);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $variable, array $params = []): array
    {
        $uri = $this->buildVariablesUri($variable);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $variable, array $params = []): array
    {
        $uri = $this->buildVariablesUri($variable);

        return $this->delete($uri, $params);
    }

    /**
     * Build the variables URI from the given parts.
     */
    protected function buildVariablesUri(string ...$parts): string
    {
        return UriBuilder::build('workspaces', $this->workspace, 'pipelines-config', 'variables', ...$parts);
    }
}
