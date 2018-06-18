<?php

namespace BearClaw\Warehousing;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise;


Class HTTPAPIClient
{
    private $client = null;
    
    private $url;
    private $username;
    private $password;
    private $httpOption;
    private $accessToken;
    private $results = [];

    public function __construct($url, $username,$password)
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
        $this->httpOption = array( 
            'auth' => [ // credentials
                $this->username, 
                $this->password
            ],
            'curl' => [ // some curl options
                CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                CURLOPT_RETURNTRANSFER => true,
            ],
            //'timeout' => 3.14
        );        
        $this->accessToken = "";
        $this->client = new Client();
    }

    public function login()
    {
        try
        {
            $response = $this->client->request(
                'GET',
                $this->url,
                $this->httpOption              
            );

            $result = $response->getBody()->getContents();
            
            //need to change later
            $this->accessToken = md5($this->username);
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }    

    public function getToken()
    {
        return $this->accessToken;
    }
    
    public function getData($urls) {
        $url = "";
        try
        {
            $promises = [];
            foreach($urls as $url)
                $promises[] = $this->client->requestAsync('GET', $url, $this->httpOption)
                ->then(function($response) {
                    array_push($this->results, $response->getBody());
                });
            
            //throw exception when errors
            //$results = Promise\unwrap($promises); 

            Promise\settle($promises)->wait();
            return $this->results;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    public function getResults() {
        return $this->results;
    }

    private function StatusCodeHandling($e)
    {
        if ($e->getResponse()->getStatusCode() == '400')
        {
            $this->prepare_access_token();
        }
        elseif ($e->getResponse()->getStatusCode() == '422')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        elseif ($e->getResponse()->getStatusCode() == '500')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        elseif ($e->getResponse()->getStatusCode() == '401')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        elseif ($e->getResponse()->getStatusCode() == '403')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        else
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
    }    
}
?>