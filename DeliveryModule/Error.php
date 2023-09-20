<?php

namespace DeliveryModule;

class Error
{
    const ERROR_PRICE = 0;
    const ERROR_DATE = null;

    public static function defaultError(string $message): array
    {
        return [
            'price' => self::ERROR_PRICE,
            'date' => self::ERROR_DATE,
            'error' => $message
        ];
    }
}