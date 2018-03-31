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

namespace Bitbucket\Api\Snippets\Users;

use Bitbucket\Api\Snippets\AbstractSnippetsApi;
use Http\Client\Common\HttpMethodsClient;

/**
 * The abstract users api class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractUsersApi extends AbstractSnippetsApi
{
    /**
     * The snippet.
     *
     * @var string
     */
    protected $snippet;

    /**
     * Create a new api instance.
     *
     * @param \Http\Client\Common\HttpMethodsClient $client
     * @param string                                $username
     * @param string                                $snippet
     */
    public function __construct(HttpMethodsClient $client, string $username, string $snippet)
    {
        parent::__construct($client, $username);
        $this->snippet = $snippet;
    }
}
