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

namespace Bitbucket\HttpClient\Util;

use ValueError;

/**
 * The is the URI builder helper class.
 *
 * @internal
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
final class UriBuilder
{
    /**
     * The URI part separator.
     *
     * @var string
     */
    private const URI_SEPARATOR = '/';

    /**
     * Build a URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    public static function buildUri(string ...$parts)
    {
        foreach ($parts as $index => $part) {
            if ('' === $part) {
                throw new ValueError(sprintf('%s::buildUri(): Argument #%d ($parts) must non-empty', self::class, $index + 1));
            }

            $parts[$index] = self::encodePart($part);
        }

        return implode(self::URI_SEPARATOR, $parts);
    }

    /**
     * Append a URI separator to the given URI.
     *
     * @param string $uri
     *
     * @return string
     */
    public static function appendSeparator(string $uri)
    {
        return sprintf('%s%s', $uri, self::URI_SEPARATOR);
    }

    /**
     * Encode the given part for a URI.
     *
     * @param string $part
     *
     * @return string
     */
    private static function encodePart(string $part)
    {
        $part = rawurlencode($part);

        return str_replace('.', '%2E', $part);
    }
}
