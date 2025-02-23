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

namespace Bitbucket\Api\Users;

use Bitbucket\HttpClient\Util\UriBuilder;

/**
 * The ssh keys API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class SshKeys extends AbstractUsersApi
{
    /**
     * @throws \Http\Client\Exception
     */
    public function list(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildSshKeysUri());

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function create(array $params = []): array
    {
        $uri = UriBuilder::appendSeparator($this->buildSshKeysUri());

        return $this->post($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function show(string $id, array $params = []): array
    {
        $uri = $this->buildSshKeysUri($id);

        return $this->get($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function update(string $id, array $params = []): array
    {
        $uri = $this->buildSshKeysUri($id);

        return $this->put($uri, $params);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function remove(string $id, array $params = []): array
    {
        $uri = $this->buildSshKeysUri($id);

        return $this->delete($uri, $params);
    }

    /**
     * Build the ssh keys URI from the given parts.
     */
    protected function buildSshKeysUri(string ...$parts): string
    {
        return UriBuilder::build('users', $this->username, 'ssh-keys', ...$parts);
    }
}
