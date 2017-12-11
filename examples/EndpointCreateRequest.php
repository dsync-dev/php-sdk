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

$data = ['foo' => 'bar'];

// create a new realtime request object with your authorization token, endpoint token and data
$request = new RealtimeRequest('yourAuthToken', 'yourEndpointToken', $data);

try {
    // send a create request
    $result = $request->create();
} catch (RealtimeRequestException $e) {
    // do something if there is an exception
}
