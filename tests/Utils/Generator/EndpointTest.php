<?php
/*
 * This file is part of the DSYNC PHP SDK package.
 *
 * (c) DSYNC <support@dsync.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dsync\PhpSdkTests;

use Dsync\PhpSdk\Utils\Generator\Endpoint;
use PHPUnit_Framework_TestCase;

/**
 * Class EndpointTest
 *
 * @package Dsync\PhpSdkTests
 */
class EndpointTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testClassConstruct()
    {
        $var = new Endpoint();
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     *
     */
    public function testGenerateEndpoint()
    {
        $endpoint = new Endpoint();

        $file = file_get_contents(__DIR__ . '/data/endpoint.json');

        $endpoint
            ->setEntityName('order')
            ->setTreekey('order')
            ->setEntityToken('source-1-order-b5503a0ae5f3bc01b6a2da68afd33305')
            ->setEndpointUrl('/entity/order');

        $endpoint = $endpoint->generate();

        self::assertEquals(json_encode(json_decode($file)), json_encode($endpoint));
    }
}
