<?php

namespace App\Rule;

class RuleTwo extends BaseRule
{
    private $productOne = 'D';
    private $productTwo = 'E';
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
        while (($index1 = array_search($this->productOne, $products) )
            &&
              ($index2 = array_search($this->productTwo, $products))
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