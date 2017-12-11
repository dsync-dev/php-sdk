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

use Dsync\PhpSdk\Http\Response;
use PHPUnit_Framework_TestCase;

/**
 * Class ResponseTest
 *
 * @package Dsync\PhpSdkTests
 */
class ResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testClassConstruct()
    {
        $var = new Response();
        $this->assertTrue(is_object($var));
        unset($var);
    }
}
