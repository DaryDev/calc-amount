<?php

namespace App\Rule;


class RuleThree extends BaseRule
{
    private $productOne = 'E';
    private $productTwo = 'F';
    private $productThree = 'G';
    private $discount = 5;

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
            && ($index3 = array_search($this->productThree, $products)) !== false
        ) {
            $amount =  $this->calcTotalAmountDiscount([$this->productOne, $this->productTwo, $this->productThree], $this->discount);
            $totalAmount += $amount;
            // удаляем товары, к которым подсчитана скидка, из оригинального массива товаров
            unset($products[$index1]);
            unset($products[$index2]);
        }

        return $totalAmount;
    }
}