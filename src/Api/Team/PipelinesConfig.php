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

namespace Bitbucket\Api\Team;

/**
 * The pipelines config api class.
 *
 * @author Graham Campbell <graham@alt-thre.com>
 */
class PipelinesConfig extends AbstractTeamApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function listVariables(array $params = [])
    {
        $path = $this->buildPipelinesConfigPath('variables');

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function createVariable(array $params = [])
    {
        $path = $this->buildPipelinesConfigPath('variables');

        return $this->post($path, $params);
    }

    /**
     * @param string $variable
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function showVariable(string $variable, array $params = [])
    {
        $path = $this->buildPipelinesConfigPath('variables', $variable);

        return $this->get($path, $params);
    }

    /**
     * @param string $variable
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function updateVariable(string $variable, array $params = [])
    {
        $path = $this->buildPipelinesConfigPath('variables', $variable);

        return $this->put($path, $params);
    }

    /**
     * @param string $variable
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function removeVariable(string $variable, array $params = [])
    {
        $path = $this->buildPipelinesConfigPath('variables', $variable);

        return $this->delete($path, $params);
    }

    /**
     * Build the pipelines config path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildPipelinesConfigPath(string ...$parts)
    {
        return static::buildPath('teams', $this->username, 'pipelines_config', ...$parts);
    }
}
