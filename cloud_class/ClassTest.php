<?php

require 'vendor/autoload.php';

use BearClaw\Warehousing\HttpService;
use BearClaw\Warehousing\PurchaseOrderService;
use BearClaw\Warehousing\TotalsCalculator;

//$purchase_order_ids = [2344, 2345, 2346];
$purchase_order_ids = [];
$totalCalculator = new TotalsCalculator();

$result = $totalCalculator->generateReport($purchase_order_ids);

//$data = $totalCalculator->getReport($purchase_order_ids);

var_dump($result);

?>