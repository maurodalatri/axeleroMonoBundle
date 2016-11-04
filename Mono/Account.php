<?php

namespace Axelero\MonoBundle\Mono;

use Axelero\MonoBundle\Log\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Account extends Mono
{
    /**
     * @inheritdoc
     */
    protected $apiPath = 'reseller/account';
}
