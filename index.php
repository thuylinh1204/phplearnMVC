<?php
require_once "vendor/autoload.php";
use App\Models\Order;
use App\Models\Shipping;
$order = new Order();
$order->addItem('PHP begin', 10.0, 1);
$order->addItem('PHP advance', 8.0, 1);

$order->setTax(0.1);

$total = $order->getTotal();

echo $total;

$shiping = new Shipping();

$shiping->addItem('PHP begin', 10.0, 1);
$shiping->addItem('PHP advance', 8.0, 1);

$shiping->setTax(0.1);
$shiping->setShiping(20);

$total = $shiping->getTotal();

echo "<br>";
echo $total;