<?php
declare(strict_types=1);

namespace DeliveryModule;

class DeliveryCalculator
{
    private array $services;

    public function __construct()
    {
        $this->services = [];
    }

    public function addDeliveryService(string $name, DeliveryServiceInterface $service): void
    {
        $this->services[$name] = $service;
    }

    public function calculateDelivery(string $selectedService, string $sourceKladr, string $targetKladr, float $weight): string
    {
        if (isset($this->services[$selectedService])) {
            $calculatedDelivery = $this->services[$selectedService]
                ->calculateCostAndDeliveryTime($sourceKladr, $targetKladr, $weight);
        } else {
            $calculatedDelivery = Error::defaultError('Invalid selected service');
        }
        return json_encode($calculatedDelivery);
    }

    public function getServices(): array
    {
        return $this->services;
    }

    public function setServices(array $services): void
    {
        $this->services = $services;
    }
}