<?php
namespace TDD\Test;
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .'autoload.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class PurchaseTotalTest extends TestCase {
	public function testPurchaseTotal() {
        $client = new Client();

        $response = $client->request('POST', 'http://localhost:8080/test', [
            'form_params' => [
              'purchase_order_ids' => ["2344","2345","2346"]
              ]
            ]);
        // echo $response->getstatusCode() . "\n\r";
        // echo $response->getBody();
        
        // $res_array = (array)json_decode($response->getBody());

        $this->assertEquals(200, $response->getStatusCode());
	}
}