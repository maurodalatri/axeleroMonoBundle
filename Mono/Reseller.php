<?php

namespace Axelero\MonoBundle\Mono;

use Axelero\MonoBundle\Log\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Reseller extends Mono
{
    /**
     * @inheritdoc
     */
    protected $apiPath = 'reseller';
}
