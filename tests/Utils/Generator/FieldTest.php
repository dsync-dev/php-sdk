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

use Dsync\PhpSdk\Utils\Generator\Field;
use PHPUnit_Framework_TestCase;

/**
 * Class FieldTest
 *
 * @package Dsync\PhpSdkTests
 */
class FieldTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testClassConstruct()
    {
        $var = new Field();
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     *
     */
    public function testGenerateField()
    {
        $field = new Field();

        $file = file_get_contents(__DIR__ . '/data/field.json');

        $field
            ->setPrimaryKey(true)
            ->setRequired(true)
            ->setTreekey('product.sku')
            ->setDescription('A product SKU')
            ->setName('sku')
            ->setType(Field::TYPE_TEXT);


        $field = $field->generate();

        self::assertEquals(json_encode(json_decode($file)), json_encode($field));
    }
}
