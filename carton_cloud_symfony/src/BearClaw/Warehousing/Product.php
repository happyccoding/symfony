<?php

namespace BearClaw\Warehousing;

class Product implements ProductInterface
{
    private $unit_quantity_initial;
    private $product_type_id;
    private $weight;
    private $volume;


    public function __construct($purchaseOrderProductValue)
    {
        $default_unit_quantity_initial = $purchaseOrderProductValue->unit_quantity_initial;
        $product = $purchaseOrderProductValue->Product;
        $this->unit_quantity_initial = isset($product->unit_quantity_initial) ? 
                    (int)$product->unit_quantity_initial : (int)$default_unit_quantity_initial;
        $this->product_type_id = $product->product_type_id;
        $this->weight = (float)$product->weight;
        $this->volume = (float)$product->volume;
    }    

    public function getProductTotal() {
        $weightProductType = $this->getWeightProductType();
        $volumeProductType = $this->getVolumeProductType();
        
        if (in_array($this->product_type_id, $weightProductType)) {
            return $this->calculateByWeight();        
        } else if (in_array($this->product_type_id, $volumeProductType)) {
            return $this->calculateByVolume();        
        }

        return 0;
    }

    public function getWeightProductType() {
        return ["1","3"];
    }


    public function getVolumeProductType() {
        return ["2"];
    }

    public function calculateByVolume() {
        return $this->unit_quantity_initial * $this->volume;
        
    }    
    
    public function calculateByWeight() {
        return $this->unit_quantity_initial * $this->weight;
        
    }    

    public function getProductTypeId(){
        return $this->product_type_id;
    }

}
