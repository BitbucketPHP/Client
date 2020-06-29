<?php

namespace Bitbucket\Tests\responses;

use GuzzleHttp\Psr7\Response;
use Http\Message\ResponseFactory;
use Psr\Http\Message\ResponseInterface;

class ProjectRemoveResponse extends BaseResponse implements ResponseFactory
{
    /**
     * @param int    $statusCode
     * @param null   $reasonPhrase
     * @param array  $headers
     * @param null   $body
     * @param string $protocolVersion
     *
     * @return Response|ResponseInterface
     */
    public function createResponse($statusCode = 200, $reasonPhrase = null, array $headers = [], $body = null, $protocolVersion = '1.1')
    {
        $json = $this->getJsonContent('stubs/project-remove-success.json');

        return new Response(200, ['Content-Type' => 'application/json'], $json);
    }
}
