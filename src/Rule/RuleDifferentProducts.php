<?php

namespace App\Rule;

/**
 * Правило для различных товаров
 */
class RuleDifferentProducts extends BaseRule
{
    /**
     * Скидки по количеству выбранных товаров
     *
     * @var array
     */
    private $countDiscounts = [
        5 => 20,
        4 => 10,
        3 => 5,
    ];

    /**
     * @var array
     */
    private $exceptedProducts;

    public function __construct(array $exceptedProducts = [])
    {
        $this->exceptedProducts = $exceptedProducts;
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
        $selectedProducts = array_diff($products, $this->exceptedProducts);

        if (!empty($selectedProducts)) {
            $productsCount = array_count_values($selectedProducts);
            foreach ($this->countDiscounts as $count => $discount) {
                if (count($productsCount) >= $count) {
                    $priceProductsCount = array_intersect_key(\App\Products::PRODUCT_PRICES, $productsCount);
                    // Применяем скидку к самым дешевым товарам
                    asort($priceProductsCount);
                    $productsToApplyDiscount = array_splice($priceProductsCount, 0, $count);
                    $sum = array_sum(array_values($productsToApplyDiscount));
                    // удаляем товары, к которым подсчитана скидка, из оригинального массива товаров
                    foreach (array_keys($productsToApplyDiscount) as $product) {
                        $index = array_search($product, $products);
                        unset($products[$index]);
                    }

                    return $sum * (100 - $discount) / 100;
                }
            }
        }

        return 0;
    }
}