<?php
/*
 * This file is part of the DSYNC PHP SDK package.
 *
 * (c) DSYNC <support@dsync.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dsync\PhpSdk\Http;

/**
 * Class Client
 *
 * @package Dsync\PhpSdk\Http
 */
class Client
{

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * Client constructor.
     *
     * @param string $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function send(Request $request)
    {

        $ch = curl_init($this->baseUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request->getMethod());
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request->getBody());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request->generateHeaders());

        $result = curl_exec($ch);
        $info   = curl_getinfo($ch);
        curl_close($ch);

        $response = new Response();

        $response
            ->setBody($result)
            ->setStatusCode($info['http_code']);

        return $response;
    }
}
