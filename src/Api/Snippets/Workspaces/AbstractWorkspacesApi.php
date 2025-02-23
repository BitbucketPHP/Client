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

namespace Bitbucket\Api\Snippets\Workspaces;

use Bitbucket\Api\Snippets\AbstractSnippetsApi;
use Bitbucket\Client;

/**
 * The abstract workspaces API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
abstract class AbstractWorkspacesApi extends AbstractSnippetsApi
{
    protected readonly string $snippet;

    public function __construct(Client $client, string $workspace, string $snippet)
    {
        parent::__construct($client, $workspace);
        $this->snippet = $snippet;
    }
}
