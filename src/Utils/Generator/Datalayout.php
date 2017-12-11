<?php
/*
 * This file is part of the DSYNC PHP SDK package.
 *
 * (c) DSYNC <support@dsync.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dsync\PhpSdk\Utils\Generator;

use Exception;

/**
 * Class Datalayout
 *
 * @package Dsync\PhpSdk\Utils\Generator
 */
class Datalayout
{

    /**
     * @var array
     */
    protected $endpoints = [];

    /**
     * @param Endpoint $endpoint
     *
     * @return $this
     */
    public function addEndpoint(Endpoint $endpoint)
    {
        $this->endpoints[] = $endpoint;

        return $this;
    }

    /**
     * @param array $endpoints
     *
     * @return $this
     * @throws Exception
     */
    public function addEndpoints(array $endpoints)
    {
        foreach ($endpoints as $endpoint) {
            if (!$endpoint instanceof Endpoint) {
                throw new Exception(
                    'Invalid type, should be type Endpoint.'
                );
            }
            $this->endpoints[] = $endpoint;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function generate()
    {
        $endpoints = [];

        foreach ($this->endpoints as $endpoint) {
            $endpoints[] = $endpoint->generate();
        }

        return [
            'data_layout' => $endpoints,
        ];
    }
}
