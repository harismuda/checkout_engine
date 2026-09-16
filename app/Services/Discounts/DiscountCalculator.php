<?php

namespace App\Services\Discounts;

use App\Contracts\DiscountStrategyInterface;

class DiscountCalculator
{
    /**
     * Create a new class instance.
     */
    public function calculate(float $totalAmount, ?DiscountStrategyInterface $strategy = null): float
    {
        if (!$strategy) {
            return $totalAmount;
        }
        return $strategy->apply($totalAmount);
    }
}
