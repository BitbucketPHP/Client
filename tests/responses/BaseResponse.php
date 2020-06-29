<?php

namespace Bitbucket\Tests\responses;

class BaseResponse
{
    /**
     * @param string $path
     *
     * @return string
     */
    protected function packagePath(string $path)
    {
        return __DIR__.'/../'.$path;
    }

    /**
     * @param string $path
     *
     * @return false|string
     */
    protected function getJsonContent(string $path)
    {
        return file_get_contents($this->packagePath($path));
    }
}
