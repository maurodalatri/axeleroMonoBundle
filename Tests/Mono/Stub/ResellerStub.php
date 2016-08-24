<?php

namespace Axelero\MonoBundle\Tests\Mono\Stub;

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
                    'offsets' => 0,
                    'itemCount' => 20,
                    'total' => 0,
                    'domains' => [
                        'domains' => [],
                        'total' => 0
                    ]
                ],
            ])
        );
    }

    public function getResellerProducts(){
        return  $response = new Response(200, [],
            json_encode([
                'status' => ['code' => 200, 'text' => '', 'timeStamp' => ''],
                'data' => [
                    'offsets' => 0,
                    'itemCount' => 20,
                    'total' => 0,
                    'resellerProducts' => [
                        'id' => 1,
                        'apiId' => 'email_1',
                        'productId' => 6,
                        'provate' => 0,
                        'isTrial' => null,
                        'upgradeToApiIds' => [],
                        'pricings' => [
                            'id' => 3695,
                            'name' => "",
                            'billingFrequency' => 12
                        ]

                    ],
                ],
            ])
        );
    }

    public function getSites(){
        return  $response = new Response(200, [],
            json_encode([
                'status' => ['code' => 200, 'text' => '', 'timeStamp' => ''],
                'data' => [
                    'offsets' => 0,
                    'itemCount' => 20,
                    'total' => 0,
                    'sites' => [
                        'sites' => [
                            'id' => 3695,
                            'accountId' => 1,
                            // ...
                        ],
                        'total' => 1

                    ],
                ],
            ])
        );
    }

    public function siteLogin(){
        return  $response = new Response(200, [],
            json_encode([
                'status' => ['code' => 200, 'text' => '', 'timeStamp' => ''],
                'data' => [
                    'ticket' => '123kjh1234kjh1234kj12734k12j34h',
                    'loginUrl' => 'http://editor.axeleromedia.it/v5/login.php',
                    'fullLoginUrl' => 'http://editor.axeleromedia.it/v5/login.php?et=%2At%40%',

                ],
            ])
        );
    }

}
