<?php
declare(strict_types=1);

include 'DeliveryModule/DeliveryCalculator.php';
include 'DeliveryModule/DeliveryServiceInterface.php';
include 'DeliveryModule/Error.php';
include 'DeliveryModule/DeliveryServices/Fast.php';
include 'DeliveryModule/DeliveryServices/Slow.php';

use DeliveryModule\DeliveryCalculator;
use DeliveryModule\DeliveryServices\Fast;
use DeliveryModule\DeliveryServices\Slow;

// for testing delivery module
$calculator = new DeliveryCalculator();
$fastDeliveryService = new Fast('https://api.fastdelivery.com');
$slowDeliveryService = new Slow('https://api.slowdelivery.com');

$calculator->addDeliveryService('fast', $fastDeliveryService);
$calculator->addDeliveryService('slow', $slowDeliveryService);

$sourceKladr = '123456789'; // КЛАДР откуда везем
$targetKladr = '987654321'; // КЛАДР куда везем
$weight = 5.0; // Вес отправления в кг

$result = $calculator->calculateDelivery('slow', $sourceKladr, $targetKladr, $weight);
printf("Slow Delivery: %s\n", $result);
$result = $calculator->calculateDelivery('fast', $sourceKladr, $targetKladr, $weight);
printf("Fast Delivery: %s\n", $result);
