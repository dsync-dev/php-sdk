<?php
/*
 * This file is part of the DSYNC PHP SDK package.
 *
 * (c) DSYNC <support@dsync.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Dsync\PhpSdk\Endpoint\RealtimeRequest;
use Dsync\PhpSdk\Exception\RealtimeRequestException;

// create a new realtime request object with your authorization token and endpoint token
$request = new RealtimeRequest('yourAuthToken', 'yourEndpointToken');

// set your primary key for the entity you wish to delete as defined by the datalayout
$request->setEntityId('primaryKeyAsDefinedInDatalayout');

try {
    // send a delete request
    $result = $request->delete();
} catch (RealtimeRequestException $e) {
    // do something if there is an exception
}
