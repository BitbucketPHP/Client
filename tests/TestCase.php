<?php

namespace Bitbucket\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    //use CreatesApplication;
    /**
     * @param $path
     * @return string
     */
    protected function packagePath($path)
    {
        return __DIR__.'/../'.$path;
    }
}
