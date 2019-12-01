<?php

namespace App\Rule;

use App\Products;

/**
 *  Базовый класс для всех правил скидок
 */
abstract class BaseRule
{
    /**
     * Расчитывает стоимость продуктов со скидкой согласно правилу.
     *
     * @param array $products
     *
     * @return float
     */
    abstract public function getAmountWithDiscount(array &$products): float;

    protected function calcTotalAmountDiscount(array $products, int $discount) {
        $sum = 0;
        foreach ($products as $product) {
            $sum += Products::getPrice($product);
        }

        return $sum * (100 - $discount) / 100;
    }
}
