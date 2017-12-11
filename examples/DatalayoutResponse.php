<?php
/*
 * This file is part of the DSYNC PHP SDK package.
 *
 * (c) DSYNC <support@dsync.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Dsync\PhpSdk\Utils\Generator\Datalayout;
use Dsync\PhpSdk\Utils\Generator\Endpoint;
use Dsync\PhpSdk\Utils\Generator\Field;

// create a new field object
$field = new Field();

// set field information
// a list of field type constants can be found in the Dsync\PhpSdk\Utils\Generator\Field class
$field
    ->setPrimaryKey(true)
    ->setRequired(true)
    ->setTreekey('product.sku')
    ->setDescription('A product SKU')
    ->setName('sku')
    ->setType(Field::TYPE_TEXT);

// create a new endpoint object
$endpoint = new Endpoint();

// set endpoint information and add all fields using the addField method
$endpoint
    ->setEntityName('product')
    ->setTreekey('product')
    ->setEntityToken('source-1-product-b5503a0ae5f3bc01b6a2da68afd33305')
    ->setEndpointUrl('/entity/product')
    ->addField($field);

// finally create a new datalayout object
$datalayout = new Datalayout();

// add all endpoints using the addEndpoint method and call the generate method
// to create the datalayout array
$datalayoutArray = $datalayout
    ->addEndpoint($endpoint)
    ->generate();

// if using Symfony or something similar to return the response
$response = new JsonResponse();

$responseArray = [
    'status' => 200,
    'message' => 'OK',
    'detail' => '',
    'data' => $datalayoutArray
];

$response->setData($responseArray);

return $response;
