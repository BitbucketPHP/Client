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

namespace Bitbucket\Api\Addon\Linkers;

use Bitbucket\Api\Addon\AbstractAddonApi;
use Bitbucket\Client;

/**
 * The abstract linkers API class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
abstract class AbstractLinkersApi extends AbstractAddonApi
{
    /**
     * The linker.
     *
     * @var string
     */
    protected $linker;

    /**
     * Create a new API instance.
     *
     * @param Client $client
     * @param string $linker
     *
     * @return void
     */
    public function __construct(Client $client, string $linker)
    {
        parent::__construct($client);
        $this->linker = $linker;
    }
}
