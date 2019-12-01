<?php

namespace App;

/**
 * Хранит продукты и цены
 */
class Products
{
    public const PRODUCT_PRICES = [
        'A' => 100,
        'B' => 50,
        'C' => 200,
        'D' => 20,
        'E' => 80,
        'F' => 100,
        'G' => 90,
        'H' => 980,
        'I' => 800,
        'J' => 50,
        'K' => 550,
        'L' => 70,
        'M' => 100,
    ];

    /**
     * Получить цену продукта
     *
     * @param string $product
     */
    public static function getPrice(string $product) : int
    {
        if (!isset(self::PRODUCT_PRICES[$product])) {
            throw new \RuntimeException('Нет данных о цене продукта ' . $product);
        }
        return self::PRODUCT_PRICES[$product];
    }
}