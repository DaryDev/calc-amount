<?php

use App\Products;

require_once 'vendor/autoload.php';

$selectedProducts = array_slice($argv, 1);
$rules = [];
$rules[] = new App\Rule\RuleGroupDiscount(['A', 'B'], 10);
$rules[] = new App\Rule\RuleGroupDiscount(['D', 'E'], 5);
$rules[] = new App\Rule\RuleGroupDiscount(['E', 'F', 'G'], 5);
$rules[] = new App\Rule\RuleFour();
$rules[] = new App\Rule\RuleDifferentProducts(['A', 'C']);

$totalAmount = 0;
/*
 * Считаем стоимость товаров, к которым применима скидка
 */
foreach ($rules as $rule) {
    $amount = $rule->getAmountWithDiscount($selectedProducts);
    $totalAmount += $amount;
}

/*
 * Считаем стоимость товаров, к которым неприменима скидка
 */
foreach ($selectedProducts as $product) {
    $totalAmount += Products::getPrice($product);
}

echo 'Стоимость товаров со скидкой: ' . number_format($totalAmount, 2, '.', ' ') . PHP_EOL;
