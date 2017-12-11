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

use Dsync\PhpSdk\Utils\Generator\Datalayout;
use Dsync\PhpSdk\Utils\Generator\Endpoint;
use Dsync\PhpSdk\Utils\Generator\Field;
use PHPUnit_Framework_TestCase;

/**
 * Class DatalayoutTest
 *
 * @package Dsync\PhpSdkTests
 */
class DatalayoutTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testClassConstruct()
    {
        $var = new Datalayout();
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     *
     */
    public function testGenerateDatalayout()
    {

        $field = new Field();

        $field
            ->setPrimaryKey(true)
            ->setRequired(true)
            ->setTreekey('product.sku')
            ->setDescription('A product SKU')
            ->setName('sku')
            ->setType(Field::TYPE_TEXT);

        $endpoint = new Endpoint();

        $endpoint
            ->setEntityName('product')
            ->setTreekey('product')
            ->setEntityToken('source-1-product-b5503a0ae5f3bc01b6a2da68afd33305')
            ->setEndpointUrl('/entity/product')
            ->addField($field);


        $dataLayout = new Datalayout();

        $dataLayout->addEndpoint($endpoint);

        $dataLayout = $dataLayout->generate();

        $file = file_get_contents(__DIR__ . '/data/datalayout.json');

        self::assertEquals(json_encode(json_decode($file)), json_encode($dataLayout));
    }

    /**
     *
     */
    public function testGenerateDatalayoutWithArrays()
    {

        $field = new Field();

        $field
            ->setPrimaryKey(true)
            ->setRequired(true)
            ->setTreekey('product.sku')
            ->setDescription('A product SKU')
            ->setName('sku')
            ->setType(Field::TYPE_TEXT);

        $endpoint = new Endpoint();

        $endpoint
            ->setEntityName('product')
            ->setTreekey('product')
            ->setEntityToken('source-1-product-b5503a0ae5f3bc01b6a2da68afd33305')
            ->setEndpointUrl('/entity/product')
            ->addFields([$field]);


        $dataLayout = new Datalayout();

        $dataLayout->addEndpoints([$endpoint]);

        $dataLayout = $dataLayout->generate();

        $file = file_get_contents(__DIR__ . '/data/datalayout.json');

        self::assertEquals(json_encode(json_decode($file)), json_encode($dataLayout));
    }
}
