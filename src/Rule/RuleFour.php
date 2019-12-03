<?php


namespace App\Rule;


class RuleFour extends BaseRule
{
    private $mainProduct;

    private $products;

    private $discount;

    public function __construct(string $mainProduct, array $products, $discount)
    {
        $this->mainProduct = $mainProduct;
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
        if ((array_search($this->mainProduct, $products)) === false) {
            return 0;
        }

        foreach ($this->products as $product) {
            if (($index = array_search($product, $products)) !== false) {
                unset($products[$index]);

                return $this->calcTotalAmountDiscount([$product], $this->discount);
            }
        }

        return 0;
    }
}