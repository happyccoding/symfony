<?php 
    namespace BearClaw\Warehousing;

    interface ProductInterface 
    { 
        public function getWeightProductType(); 
        public function getVolumeProductType(); 
        public function calculateByWeight(); 
        public function calculateByVolume(); 
    } 

?>