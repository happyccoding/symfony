<?php

namespace BearClaw\Warehousing;

class PurchaseOrderService
{
    const URL = 'https://api.cartoncloud.com.au/CartonCloud_Demo/PurchaseOrders/{$id}?version=5&associated=true';
    private $username = 'interview-test@cartoncloud.com.au';
    private $password = 'test123456'; 

    /**
     * @param array $ids
     */
    public function calculateTotals($ids) {
        $final = []; $result = []; $urls = [];
        foreach ($ids as $id) {
            array_push($urls, preg_replace('/\{.*\}/', $id, $this::URL));
        }

        //get json result
        $httpClient = new HTTPAPIClient($this::URL, $this->username, $this->password);
        $jsons = $httpClient->getData($urls);

        //group by unique key
        foreach ($jsons as $json) {
            $result = self::getProductTotals($json);
            array_walk_recursive($result, function($item, $key) use (&$final){
                $final[$key] = isset($final[$key]) ?  $item + $final[$key] : $item;
            });         
        }

        //sort by key
        ksort($final);

        //final result
        $result = [];
        foreach($final as $key => $value) {
            $tmpArray = [];
            $tmpArray["product_type_id"] = $key;
            $tmpArray["total"] = $value;
            array_push($result, $tmpArray);
        } 

        return $result;
    }

    //parsing json and get products total
    public function getProductTotals($json) {

        $arr = json_decode($json );
        $isSuccess = $arr->info;
        $result = array();

        if ($isSuccess=="SUCCESS") {
            $data = $arr->data;
            foreach($data as $key => $value){
                if ($key=='PurchaseOrderProduct') {
                    $purchaseOrderProduct = $value;
                    foreach($purchaseOrderProduct as $purchaseOrderProductValue){
                        $product = new Product($purchaseOrderProductValue);
                        $productTotals = $product->getProductTotal();
                        $product_type_id = $product->getProductTypeId();
                        $result[$product_type_id] = isset($result[$product_type_id]) ?  
                                $result[$product_type_id] + $productTotal : $productTotals;
                    }
                }
            }

            return $result;
        }   
    }  


    
}
