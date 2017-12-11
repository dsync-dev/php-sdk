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

use Dsync\PhpSdk\Http\Client;
use Dsync\PhpSdk\Http\Request;
use Dsync\PhpSdk\Http\Response;
use PHPUnit_Framework_TestCase;

/**
 * Class ClientTest
 *
 * @package Dsync\PhpSdkTests
 */
class ClientTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testClassConstruct()
    {
        $var = new Client('http://some.url');
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     *
     */
    public function testSend()
    {
        $client = new Client('https://api.dsync.com/start');

        $request = new Request();

        $request
            ->setMethod('GET');

        $result = $client->send($request);

        self::assertEquals(200, $result->getStatusCode());
        self::assertInstanceOf(Response::class, $result);
    }
}
