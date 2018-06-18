<?php

namespace Tests\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\Client;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function testTest()
    {

        $client = new Client();
        
        $response = $client->request('POST', 'http://localhost:8080/test', [
            'form_params' => [
              'purchase_order_ids' => ["2344","2345","2346"]
              ]
            ]);

        $this->assertEquals(200, $response->getStatusCode());
    }    
}
