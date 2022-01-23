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

/**
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
final class Resource
{
    /**
     * @param string $path
     *
     * @return string
     */
    public static function get(string $path)
    {
        $content = @\file_get_contents(\sprintf('%s/Resource/%s', __DIR__, $path));

        if (false === $content) {
            throw new \RuntimeException(\sprintf('Unable to read resource [%s].', $path));
        }

        return $content;
    }
}
