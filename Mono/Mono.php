<?php

namespace Axelero\MonoBundle\Mono;

use Axelero\MonoBundle\Log\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use phpDocumentor\Reflection\Types\Object_;

abstract class Mono
{
    /**
     * @var Client
     * The GuzzleHttp Client
     */
    protected $client;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var string
     * The REST API base endpoint
     */
    protected $endpoint = 'https://hal.mono.net/api/v1/';


    /**
     * @var string the api path form specific resource
     * Ex.: reseller (for api/v1/reseller @see https://www.monoextranet.com/halapi/class-api_reseller.php)
     * It must be defined in single extend class
     *
     */
    protected $apiPath = '';

    /**
     * @var string
     *             The Mono API Reseller Token to authenticate with
     */
    protected $api_reseller_token;

    /**
     * @var Object
     */
    protected $response;

    /**
     * Mono constructor.
     *
     * @param string $api_reseller_token
     * @param Logger $logger
     * @param Client $client
     */
    public function __construct($api_reseller_token, Logger $logger, Client $client)
    {
        $this->api_reseller_token = $api_reseller_token;
        $this->logger = $logger;
        $this->client = $client;

        if(empty($this->apiPath)) Throw new MonoApiException("You must define 'apiPath' in extended class view comment in " . __CLASS__);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws MonoApiException
     */
    public function __call($name, $arguments)
    {

        // Note: value of $name is case sensitive.
        $info = $this->request($this->apiPath,$name, $arguments);
        if (!$info['success']) {
            throw new MonoApiException($info['data']->status->text);
        }

        return $info['data'];
    }

    /**
     * Makes a request to the MailChimp API.
     *
     * @param string $path
     * The API path to request
     * @param string $command
     * The string of command Ex.: getInfo
     * @param array  $parameters
     * Associative array of parameters to send in POST
     *
     * @return array
     */
    protected function request($path, $command, $parameters = null)
    {
        $postParams = current($parameters);
        $postParams['command'] = $command;
        $postParams['userToken'] = $this->api_reseller_token;
        $guzzleResponse = $this->client->request('POST', $this->endpoint.$path, ['form_params' => $postParams]);


        $this->response = json_decode($guzzleResponse->getBody());

        $isError = $this->isErrorResponse($this->response->status);

        $this->logResponse($path, $postParams, $guzzleResponse);

        return ['success' => !$isError, 'data' => (object)$this->response];
    }


    /**
     * @param $status
     * @return bool
     */
    protected function isErrorResponse($status)
    {
        return $status->code != 200;
    }

    private function logResponse($path, $postParams, $guzzleResponse){
        $responseToLog = json_decode($guzzleResponse->getBody(), true);

        $toProfiler['Url'] = $this->endpoint.$path;
        $toProfiler['Command'] = $postParams['command'];
        $toProfiler['postParams'] = $postParams;
        $toProfiler['status'] = $responseToLog['status'];

        if (!empty($responseToLog['data'])) {
            foreach ($responseToLog['data'] as $data) {
                $toProfiler['data'][] = $data;
            }
        }
        $this->logger->logRequest($toProfiler);
    }




}
