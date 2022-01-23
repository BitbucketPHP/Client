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

namespace Bitbucket\HttpClient\Util;

use ValueError;

/**
 * The is the URI builder helper class.
 *
 * @internal
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
final class UriBuilder
{
    /**
     * Build a URI from the given parts.
     *
     * @param string ...$parts
     *
     * @return string
     */
    public static function build(string ...$parts): string
    {
        /** @var int $index */
        foreach ($parts as $index => $part) {
            if ('' === $part) {
                throw new ValueError(\sprintf('%s::buildUri(): Argument #%d ($parts) must non-empty', self::class, $index + 1));
            }

            $parts[$index] = \rawurlencode($part);
        }

        return \implode('/', $parts);
    }

    /**
     * Append a URI separator to the given URI.
     *
     * @param string $uri
     *
     * @return string
     */
    public static function appendSeparator(string $uri): string
    {
        return \sprintf('%s%s', $uri, '/');
    }
}
