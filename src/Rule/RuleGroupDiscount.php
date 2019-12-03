<?php

namespace App\Rule;

class RuleGroupDiscount extends BaseRule
{
    /**
     * Продукты, которые участвуют в скидке
     *
     * @var array
     */
    private $products;

    /**
     * Процент скидки
     *
     * @var int
     */
    private $discount;

    public function __construct(array $products, int $discount)
    {
        $this->products = $products;
        $this->discount = $discount;
    }

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
        $condition = true;
        while ($condition === true){
            $count = 0;
            $indexToDeleteProducts = [];
            foreach ($this->products as $product) {
                if (($index = array_search($product, $products)) !== false) {
                    $count += 1;
                    $indexToDeleteProducts[] = $index;
                }
            }

            if ($count === count($this->products)) {
                $totalAmount += $this->calcTotalAmountDiscount($this->products, $this->discount);
                foreach ($indexToDeleteProducts as $index) {
                    unset($products[$index]);
                }

            } else {
                $condition = false;
            }
        }

        return $totalAmount;
    }

}