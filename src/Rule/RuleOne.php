<?php

namespace App\Rule;

class RuleOne extends BaseRule
{
    private $productOne = 'A';
    private $productTwo = 'B';
    private $discount = 10;

    /**
     * Расчитывает стоимость продуктов со скидкой согласно правилу.
     *
     * @param array $products
     *
     * @return float
     */
    public function getAmountWithDiscount(array &$products): float
    {
        $totalAmount = 0;
        while (
            ($index1 = array_search($this->productOne, $products)) !== false
            && ($index2 = array_search($this->productTwo, $products)) !== false
        ) {
            $amount =  $this->calcTotalAmountDiscount([$this->productOne, $this->productTwo], $this->discount);
            $totalAmount += $amount;
            // удаляем товары, к которым подсчитана скидка, из оригинального массива товаров
            unset($products[$index1]);
            unset($products[$index2]);
        }

        return $totalAmount;
    }

}