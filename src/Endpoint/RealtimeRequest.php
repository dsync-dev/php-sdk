<?php
/*
 * This file is part of the DSYNC PHP SDK package.
 *
 * (c) DSYNC <support@dsync.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dsync\PhpSdk\Endpoint;

use Dsync\PhpSdk\Exception\RealtimeRequestException;
use Dsync\PhpSdk\Http\Client;
use Dsync\PhpSdk\Http\Request as HttpRequest;
use Dsync\PhpSdk\Http\Response as HttpResponse;
use Exception;

/**
 * Class RealtimeRequest
 *
 * @package Dsync\PhpSdk\Endpoint
 */
class RealtimeRequest
{

    const DEFAULT_URL = 'https://api.dsync.com/api/realtime';

    /**
     * @var string
     */
    protected $authToken;

    /**
     * @var string
     */
    protected $entityToken;

    /**
     * @var string
     */
    protected $entityId;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var HttpRequest
     */
    protected $lastRequest;

    /**
     * @var HttpResponse
     */
    protected $lastResponse;

    /**
     * @var string
     */
    protected $realtimeUrl;

    /**
     * Request constructor.
     *
     * @param string|null $authToken
     * @param string|null $entityToken
     * @param mixed|null  $data
     */
    public function __construct(
        $authToken = null,
        $entityToken = null,
        $data = null
    ) {
        $this->authToken   = $authToken;
        $this->entityToken = $entityToken;
        $this->data        = $data;
        $this->realtimeUrl = self::DEFAULT_URL;
    }

    /**
     * @param string $authToken
     *
     * @return $this
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @param string $entityToken
     *
     * @return $this
     */
    public function setEntityToken($entityToken)
    {
        $this->entityToken = $entityToken;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getEntityToken()
    {
        return $this->entityToken;
    }

    /**
     * @param string $entityId
     *
     * @return $this
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * @return string
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $realtimeUrl
     *
     * @return $this
     */
    public function setRealtimeUrl($realtimeUrl)
    {
        $this->realtimeUrl = $realtimeUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getRealtimeUrl()
    {
        return $this->realtimeUrl;
    }

    /**
     * @return HttpRequest
     */
    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    /**
     * @return HttpResponse
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * @param array|null $data
     *
     * @return HttpResponse
     */
    public function create($data = null)
    {
        $this->init($data);

        return $this->makeRequest('POST');
    }

    /**
     * @param array|null $data
     *
     * @return HttpResponse
     */
    public function update($data = null)
    {
        $this->init($data);

        return $this->makeRequest('PUT');
    }

    /**
     * @param array|null $data
     *
     * @return HttpResponse
     */
    public function delete($data = null)
    {
        $this->init($data, true);

        return $this->makeRequest('DELETE', true);
    }

    /**
     * @param string $method
     * @param bool   $deleteAction
     *
     * @return mixed
     * @throws RealtimeRequestException
     */
    protected function makeRequest($method, $deleteAction = false)
    {
        try {
            // reset last request and last response
            $this->lastRequest  = null;
            $this->lastResponse = null;

            $httpRequest = new HttpRequest();

            if ($deleteAction) {
                $httpRequest->addHeader('Entity-Id', $this->getEntityId());
            } else {
                $httpRequest->setBody(json_encode($this->getData()));
            }

            $httpRequest
                ->addHeader('Content-Type', 'application/json')
                ->addHeader('Entity-Token', $this->getEntityToken())
                ->addHeader('Auth-Token', $this->getAuthToken())
                ->setMethod($method);

            $httpClient = new Client($this->realtimeUrl);

            $this->lastRequest = $httpRequest;

            $httpResponse = $httpClient->send($httpRequest);

            $this->lastResponse = $httpResponse;

            // reset data and entity id
            $this->data         = null;
            $this->entityId     = null;

            $responseArray = json_decode($httpResponse->getBody(), true);
            if ($httpResponse->getStatusCode() != 200) {
                $errorMessage  = 'There was an error making this realtime request.';
                if (is_array($responseArray) && isset($responseArray['message'])) {
                    $errorMessage = $responseArray['message'];
                }
                throw new Exception($httpResponse->getStatusCode() . ': ' . $errorMessage);
            }

            return $responseArray;
        } catch (Exception $e) {
            throw new RealtimeRequestException($e->getMessage());
        }
    }

    /**
     * @param array|null $data
     * @param bool       $deleteAction
     */
    protected function init($data, $deleteAction = false)
    {
        if ($data) {
            $this->setData($data);
        }

        $this->validate($deleteAction);
    }

    /**
     * @throws Exception
     */
    protected function validate($deleteAction)
    {
        $error = null;

        if (!$this->getAuthToken()) {
            $error .= 'Missing authorization token from request. ';
        }

        if (!$this->getEntityToken()) {
            $error .= 'Missing entity token from request. ';
        }

        if ($deleteAction && !$this->getEntityId()) {
            $error .= 'Missing entity ID from request. ';
        }

        if ($error) {
            throw new RealtimeRequestException($error);
        }
    }
}
