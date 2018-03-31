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
use Http\Client\Common\HttpMethodsClient;

/**
 * The abstract linkers api class.
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
     * Create a new api instance.
     *
     * @param \Http\Client\Common\HttpMethodsClient $client
     * @param string                                $linker
     */
    public function __construct(HttpMethodsClient $client, string $linker)
    {
        parent::__construct($client);
        $this->linker = $linker;
    }
}
