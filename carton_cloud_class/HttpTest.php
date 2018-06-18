<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

$client = new Client();

$response = $client->request('POST', 'http://localhost:8080/test', [
    'form_params' => [
      'purchase_order_ids' => ["2344","2345","2346"]
      ]
    ]);
echo $response->getstatusCode() . "\n\r";
echo $response->getBody();

$res_array = (array)json_decode($response->getBody());
echo var_dump($res_array);

//echo var_dump($response);
?>