<?php
declare(strict_types=1);

namespace DeliveryModule\DeliveryServices;

use DeliveryModule\DeliveryServiceInterface;
use DeliveryModule\Error;

class Fast implements DeliveryServiceInterface
{
    private string $base_url;

    public function __construct($base_url)
    {
        $this->base_url = $base_url;
    }

    public function calculateCostAndDeliveryTime(string $sourceKladr, string $targetKladr, float $weight): array
    {
        // Эмулирование запроса к API "Быстрой доставки" и получение данных
        $jsonResponse = '{"price": 10.0, "period": 2, "error": null}';
        $dataFromAPI = json_decode($jsonResponse);

        if (!is_null($dataFromAPI->error)) {
            return Error::defaultError($dataFromAPI->error);
        }

        return [
            'price' => $dataFromAPI->price,
            'date' => $this->calculateDeliveryTimeByPeriod($dataFromAPI->period),
            'error' => null,
        ];
    }

    private function calculateDeliveryTimeByPeriod(int $period): string
    {
        $currentDate = date(self::DATE_FORMAT);
        $newDate = $currentDate . ' + ' . $period . ' days';
        return date(self::DATE_FORMAT, strtotime($newDate));
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