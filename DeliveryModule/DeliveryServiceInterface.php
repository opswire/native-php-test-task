<?php
declare(strict_types=1);

namespace DeliveryModule;
interface DeliveryServiceInterface
{
    const DATE_FORMAT = 'Y-m-d';

    public function calculateCostAndDeliveryTime(string $sourceKladr, string $targetKladr, float $weight): array;
}