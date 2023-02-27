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

namespace Bitbucket\Tests;

use Bitbucket\Exception\RuntimeException;
use Bitbucket\HttpClient\Message\ResponseMediator;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class ResponseMediatorTest extends TestCase
{
    public function testGetContent(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            Utils::streamFor('{"foo": "bar"}')
        );

        self::assertSame(['foo' => 'bar'], ResponseMediator::getContent($response));
    }

    public function testGetContentNotJson(): void
    {
        $body = 'foobar';
        $response = new Response(
            200,
            [],
            Utils::streamFor($body)
        );

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('The content type was not application/json.');

        ResponseMediator::getContent($response);
    }

    public function testGetContentInvalidJson(): void
    {
        $body = 'foobar';
        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            Utils::streamFor($body)
        );

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('json_decode error: Syntax error');

        ResponseMediator::getContent($response);
    }

    public function testGetErrrorMessageInvalidJson(): void
    {
        $body = 'foobar';
        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            Utils::streamFor($body)
        );

        self::assertNull(ResponseMediator::getErrorMessage($response));
    }
}
