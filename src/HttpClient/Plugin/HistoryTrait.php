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

namespace Bitbucket\HttpClient\Plugin;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Exception;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;

if (interface_exists(HttpMethodsClientInterface::class)) {
    trait HistoryTrait
    {
        public function addFailure(RequestInterface $request, ClientExceptionInterface $exception)
        {
        }
    }
} else {
    trait HistoryTrait
    {
        public function addFailure(RequestInterface $request, Exception $exception)
        {
        }
    }
}
