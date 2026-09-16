<?php

namespace App\Services\Discounts;

use App\Contracts\DiscountStrategyInterface;

class PercentageDiscount implements DiscountStrategyInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private float $percentage
    ) {}
    
    public function apply(float $totalAmount): float
    {
        $discount = ($this->percentage / 100) * $totalAmount;
        return max(0, $totalAmount - $discount);
    }

    public function name(): string
    {
        return "Diskon {$this->percentage}%";
    }
}
