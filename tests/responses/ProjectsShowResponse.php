<?php

namespace Bitbucket\Tests\responses;

use GuzzleHttp\Psr7\Response;
use Http\Message\ResponseFactory;
use Psr\Http\Message\ResponseInterface;

class ProjectsShowResponse extends BaseResponse implements ResponseFactory
{
    /**
     * @param int $statusCode
     * @param null $reasonPhrase
     * @param array $headers
     * @param null $body
     * @param string $protocolVersion
     * @return Response|ResponseInterface
     */
    public function createResponse($statusCode = 200, $reasonPhrase = null, array $headers = [], $body = null, $protocolVersion = '1.1')
    {
        $json = $this->getJsonContent('stubs/projects-show-success.json');
        return new Response($statusCode, ['Content-Type' => 'application/json'], $json);
    }
}