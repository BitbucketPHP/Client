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

namespace Bitbucket\Tests\Response;

use Bitbucket\Tests\Resource;
use GuzzleHttp\Psr7\Response;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 * @author Giacomo Fabbian <info@giacomofabbian.it>
 */
final class ProjectsShowResponse
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public static function create()
    {
        $body = Resource::get('projects-show-success.json');

        return new Response(200, ['Content-Type' => 'application/json'], $body);
    }
}
