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

$data = ['foo' => 'foo'];

// create a new realtime request object
$request = new RealtimeRequest();

// set your authorization token, endpoint token and data on the request
$request
    ->setAuthToken('yourAuthToken')
    ->setEntityToken('yourEndpointToken')
    ->setData($data);

try {
    // send an update request
    $result = $request->update();
} catch (RealtimeRequestException $e) {
    // do something if there is an exception
}
