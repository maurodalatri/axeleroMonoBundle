<?php

namespace Axelero\MonoBundle\Mono;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Axelero\MonoBundle\Log\Logger;

class Mono {

    /**
     * @var Client $client
     *   The GuzzleHttp Client.
     */
    protected $client;

    /**
     * @var Logger
     */
    private $logger;


    /**
     * @var string $endpoint
     *   The REST API endpoint.
     */
    protected $endpoint = 'https://hal.mono.net/api/v1/';

    /**
     * @var string $api_reseller_token
     *   The Mono API Reseller Token to authenticate with.
     */
    private $api_reseller_token;


    /**
     * Mono constructor.
     *
     * @param string $api_reseller_token
     *   The Mono API  reseller token.
     *
     * @param int $timeout
     *   Maximum request time in seconds.
     */
    public function __construct($api_reseller_token, Logger $logger, $timeout = 10) {

        $this->logger = $logger;

        $this->api_reseller_token = $api_reseller_token;

        $this->client = new Client([
            'timeout' => $timeout,
        ]);
    }


    public function getResellerInfo() {

        return  $this->request("reseller/account", "getInfo");
    }


    /**
     * Makes a request to the MailChimp API.
     *
     * @param string $path
     *   The API path to request.
     * @param string $command
     *   The string of command Ex.: getInfo
     * @param array $parameters
     *   Associative array of parameters to send in POST
     *
     * @return object
     *
     * @throws MonoAPIException
     */
    protected function request($path, $command, $parameters = NULL) {
        try {

            $postParams = $parameters;
            $postParams["command"] = $command;
            $postParams["userToken"] = $this->api_reseller_token;
            $response = $this->client->request("POST", $this->endpoint.$path, $postParams);
            $data = json_decode($response->getBody());

            $responseToLog = json_decode($response->getBody(), true);

            $toProfiler = $responseToLog['status'];
            $toProfiler['Url'] = $this->endpoint.$path;
            $toProfiler['postParams'] = http_build_query($postParams);

            $this->logger->logRequest($toProfiler);

            return $data;

        }
        catch (RequestException $e) {
            $response = $e->getResponse();
            if (!empty($response)) {
                $message = $e->getResponse()->getBody();
            }
            else {
                $message = $e->getMessage();
            }

            throw new MonoAPIException($message, $e->getCode(), $e);
        }
    }



}