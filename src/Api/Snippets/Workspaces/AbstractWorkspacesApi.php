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

namespace Bitbucket\Api\Snippets\Workspaces;

use Bitbucket\Api\Snippets\AbstractSnippetsApi;
use Bitbucket\Client;

/**
 * The abstract workspaces API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractWorkspacesApi extends AbstractSnippetsApi
{
    /**
     * The snippet.
     *
     * @var string
     */
    protected $snippet;

    /**
     * Create a new API instance.
     *
     * @param Client $client
     * @param string $workspace
     * @param string $snippet
     *
     * @return void
     */
    public function __construct(Client $client, string $workspace, string $snippet)
    {
        parent::__construct($client, $workspace);
        $this->snippet = $snippet;
    }
}
