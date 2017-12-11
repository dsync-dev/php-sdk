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

use Dsync\PhpSdk\Utils\Generator\EntityToken;
use PHPUnit_Framework_TestCase;

/**
 * Class EntityTokenTest
 *
 * @package Dsync\PhpSdkTests
 */
class EntityTokenTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testClassConstruct()
    {
        $var = new EntityToken();
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     *
     */
    public function testGenerateEntityToken()
    {
        $entityTokenClass = new EntityToken();

        $entityToken = $entityTokenClass->generateEntityToken('bGdG');

        $this->assertStringStartsWith('php-sdk-bgdg-', $entityToken);
    }
}
