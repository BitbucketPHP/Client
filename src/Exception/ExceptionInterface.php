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

namespace Bitbucket\Exception;

use Http\Client\Exception;

/**
 * This is the bitbucket exception interface.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
interface ExceptionInterface extends Exception
{
    //
}
