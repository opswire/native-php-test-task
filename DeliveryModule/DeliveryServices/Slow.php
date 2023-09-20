<?php
declare(strict_types=1);

namespace DeliveryModule\DeliveryServices;

use DeliveryModule\DeliveryServiceInterface;
use DeliveryModule\Error;

class Slow implements DeliveryServiceInterface
{
    const BASE_COST = 150;

    private string $base_url;

    public function __construct($base_url)
    {
        $this->base_url = $base_url;
    }

    public function calculateCostAndDeliveryTime(string $sourceKladr, string $targetKladr, float $weight): array
    {
        // Эмулирование запроса к API "Быстрой доставки" и получение данных
        $jsonResponse = '{"coefficient": 1.6, "date": "2023-09-25", "error": null}';
        $dataFromAPI = json_decode($jsonResponse);

        if (!is_null($dataFromAPI->error)) {
            return Error::defaultError($dataFromAPI->error);
        }

        return [
            'price' => $this->calculateFinalCost($dataFromAPI->coefficient),
            'date' => $dataFromAPI->date,
            'error' => null,
        ];
    }

    private function calculateFinalCost(float $coefficient): float
    {
        return self::BASE_COST * $coefficient;
    }

    public function getBaseUrl(): string
    {
        return $this->base_url;
    }

    public function setBaseUrl(string $base_url): void
    {
        $this->base_url = $base_url;
    }
}