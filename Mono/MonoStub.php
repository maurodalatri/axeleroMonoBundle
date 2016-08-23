<?php

namespace Axelero\MonoBundle\Mono;

use Axelero\MonoBundle\Log\Logger;
use Axelero\MonoBundle\Mono\MonoApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;


class MonoStub extends Mono {

    public function getResellerInfo() {

        return  $response = new Response(200, [],
            json_encode([
                'status'=> ['code' => 200, 'text'=>'', 'timeStamp'=>'' ],
                'data'=> [
                    'reseller' => [
                        'id'=>1,
                        'name'=>'Reseller',
                        'toolDomain' => 'http://monosolutions.it'
                    ]
                ]
            ])
        );
    }


}