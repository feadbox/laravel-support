<?php

namespace Feadbox\Support\Components;

class Money
{
    public static function format($money, $prefix = '₺'): string
    {
        return $prefix . number_format(static::convertFromCents($money), 2);
    }

    public static function formatWithoutPrefix($money): string
    {
        return static::format($money, '');
    }

    public static function toFloat($money): float
    {
        if (is_null($money)) {
            return 0;
        }

        $money = preg_replace('/[^0-9.]/', '', $money);

        return (float) str_replace(',', '', $money);
    }

    public static function convertToCents($money): ?float
    {
        return !is_null($money) ? static::toFloat($money) * 100 : NULL;
    }

    public static function convertFromCents($money)
    {
        return !is_null($money) ? round($money / 100, 2) : NULL;
    }

    public static function getAmountWithoutTax(int $amount, int $rate): int
    {
        return static::convertToCents(static::convertFromCents($amount) / (($rate / 100) + 1));
    }

    public static function calculateTax(int $amount, int $rate): int
    {
        return $amount - self::getAmountWithoutTax($amount, $rate);
    }
}
