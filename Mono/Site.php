<?php

namespace Axelero\MonoBundle\Mono;

use Axelero\MonoBundle\Log\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Site extends Mono
{
    /**
     * @inheritdoc
     */
    protected $apiPath = 'reseller/account/site';
}
