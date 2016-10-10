<?php

namespace Axelero\MonoBundle\Tests\Mono\Stub;

use Axelero\MonoBundle\Mono\MonoInterface;
use GuzzleHttp\Psr7\Response;

class SiteStub implements MonoInterface
{

    public function getGlobalData(){
        return  $response = new Response(200, [],
            json_encode([
                'status' => ['code' => 200, 'text' => '', 'timeStamp' => ''],
                'data' => [
                    [
                        'globalData' => [
                            'company_name' => "Azienda",
                            'street' => "indirizzo",
                            'zip' => "00100",
                            'city' => 'Citta',
                            'logo' => ''
                        ]
                    ]

                ],
            ])
        );
    }

}
