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

namespace Bitbucket\Tests;

use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;
use Bitbucket\Exception\RuntimeException;
use Bitbucket\HttpClient\Message\ResponseMediator;
use GuzzleHttp\Psr7;
use PHPUnit\Framework\TestCase;

/**
 * @author Graham Campbell <graham@alt-three.com>
 */
class ResponseMediatorTest extends TestCase
{
    public function testGetContent()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            stream_for('{"foo": "bar"}')
        );

        $this->assertSame(['foo' => 'bar'], ResponseMediator::getContent($response));
    }

    public function testGetContentNotJson()
    {
        $body = 'foobar';
        $response = new Response(
            200,
            [],
            stream_for($body)
        );

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('The content type was not application/json.');

        ResponseMediator::getContent($response);
    }

    public function testGetContentInvalidJson()
    {
        $body = 'foobar';
        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            stream_for($body)
        );

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('json_decode error: Syntax error');

        ResponseMediator::getContent($response);
    }

    public function testGetErrrorMessageInvalidJson()
    {
        $body = 'foobar';
        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            stream_for($body)
        );

        $this->assertNull(ResponseMediator::getErrorMessage($response));
    }
}
