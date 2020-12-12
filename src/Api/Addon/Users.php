<?php

declare(strict_types=1);

/*
 * This file is part of the Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api\Addon;

use Bitbucket\Api\Addon\Users\Events;

/**
 * The users API class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Users extends AbstractAddonApi
{
    /**
     * @param string $username
     *
     * @return \Bitbucket\Api\Addon\Users\Events
     */
    public function events(string $username)
    {
        return new Events($this->getClient(), $username);
    }
}
