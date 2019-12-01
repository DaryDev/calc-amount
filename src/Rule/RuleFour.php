<?php


namespace App\Rule;


class RuleFour extends BaseRule
{
    /**
     * Расчитывает стоимость продуктов со скидкой согласно правилу.
     *
     * @param array $products
     *
     * @return float
     */
    private $productOne = 'A';
    private $productTwo = 'K';
    private $productThree = 'L';
    private $productFour = 'M';
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
        if (
            (array_search($this->productOne, $products)) !== false
            &&
            (($index1 = array_search($this->productTwo, $products)) !== false
            || ($index2 = array_search($this->productThree, $products)) !== false
            || ($index3 = array_search($this->productFour, $products)) !== false
            )
        ) {
            if ($index1 !== false) {
                unset($products[$index1]);
                return $this->calcTotalAmountDiscount([$this->productTwo], $this->discount);
            }
            if ($index2 !== false) {
                unset($products[$index2]);
                return $this->calcTotalAmountDiscount([$this->productThree], $this->discount);
            }
            if ($index1 !== false) {
                unset($products[$index3]);
                return $this->calcTotalAmountDiscount([$this->productFour], $this->discount);
            }
        }

        return 0;
    }
}