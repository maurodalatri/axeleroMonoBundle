<?php

namespace Axelero\MonoBundle\Tests;

use Axelero\MonoBundle\Mono\Reseller;
use Axelero\MonoBundle\Log\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class ResellerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetResellerInfo()
    {
        $response = new Response(200, [],
            json_encode([
                'status' => ['code' => 200],
                'data' => [
                    'reseller' => [
                        'id' => 1,
                        'name' => 'Reseller',
                        'toolDomain' => 'http://monosolutions.it',
                    ],
                ],
            ])
        );

        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $mono = new Reseller('stringafakeToken', new Logger(), $client);
        $response = $mono->getInfo();

        $this->assertEquals('Reseller', $response->data->reseller->name);
    }

    /**
     * @expectedException Axelero\MonoBundle\Mono\MonoApiException
     */
    public function testGetResellerInfoWithError()
    {
        $response = new Response(200, [],
            json_encode([
                'status' => ['code' => 404, 'text' => 'Access denied', 'timeStamp' => ''],
                'data' => [],
            ])
        );

        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $mono = new Reseller('stringafakeToken', new Logger(), $client);
        $mono->getInfo();
    }
}
