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

namespace Bitbucket\Api\Addon\Linkers;

use Bitbucket\Api\Addon\AbstractAddonApi;
use Bitbucket\Client;

/**
 * The abstract linkers API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
     * @param Client   $client
     * @param string   $linker
     * @param int|null $perPage
     *
     * @return void
     */
    public function __construct(Client $client, string $linker, int $perPage = null)
    {
        parent::__construct($client, $perPage);
        $this->linker = $linker;
    }
}
