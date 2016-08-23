<?php

namespace Axelero\MonoBundle\Mono;

use Axelero\MonoBundle\Log\Logger;
use Axelero\MonoBundle\Mono\MonoApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;



class Mono {

    /**
     * @var Client $client
     *    The GuzzleHttp Client.
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
     * @param Logger $logger
     * @param Client $client
     */
    public function __construct($api_reseller_token, Logger $logger, Client $client)
    {
        $this->api_reseller_token   = $api_reseller_token;
        $this->logger               = $logger;
        $this->client               = $client;
    }


    public function getResellerInfo() {

        return  $this->request("reseller", "getInfo");
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
    protected function request($path, $command, $parameters = NULL)
    {
        $postParams = $parameters;
        $postParams["command"] = $command;
        $postParams["userToken"] = $this->api_reseller_token;
        $guzzleResponse = $this->client->request("POST", $this->endpoint . $path, ['form_params' => $postParams]);
        $response = json_decode($guzzleResponse->getBody());

        // Logga la response per il DataCollector da mostrare sul Profiler di Symfony
        $responseToLog = json_decode($guzzleResponse->getBody(), true);
        $toProfiler['Url'] = $this->endpoint . $path;
        $toProfiler['postParams'] = http_build_query($postParams);
        $toProfiler['status'] = $responseToLog['status'];

        if (!empty($responseToLog['data'])) {
            foreach ($responseToLog['data'] as $data) {
                $toProfiler['data'][] = $data;
            }
        }
        $this->logger->logRequest($toProfiler);

        if($this->isErrorResponse($response->status)){
            Throw new MonoApiException();
        }

        return $response;

    }

    protected function isErrorResponse($status){
        return $status->code != 200;
    }
}