<?php

namespace Axelero\MonoBundle\Mono;

use GuzzleHttp\Psr7\Response;

class ResellerStub
{
    public function getInfo(){
        return  $response = new Response(200, [],
            json_encode([
                'status' => ['code' => 200, 'text' => '', 'timeStamp' => ''],
                'data' => [
                    'reseller' => [
                        'id' => 1,
                        'name' => 'Reseller',
                        'toolDomain' => 'http://monosolutions.it',
                    ],
                ],
            ])
        );
    }

    public function getDomains(){
        return  $response = new Response(200, [],
            json_encode([
                'status' => ['code' => 200, 'text' => '', 'timeStamp' => ''],
                'data' => [
                    'reseller' => [
                        'id' => 1,
                        'name' => 'Reseller',
                        'toolDomain' => 'http://monosolutions.it',
                    ],
                ],
            ])
        );
    }

    public function getResellerProducts(){
        return  $response = new Response(200, [],
            json_encode([
                'status' => ['code' => 200, 'text' => '', 'timeStamp' => ''],
                'data' => [
                    'reseller' => [
                        'id' => 1,
                        'name' => 'Reseller',
                        'toolDomain' => 'http://monosolutions.it',
                    ],
                ],
            ])
        );
    }



}
