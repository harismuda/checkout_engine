<?php

namespace App\Services\Discounts;

use App\Contracts\DiscountStrategyInterface;

class FixedDiscount implements DiscountStrategyInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private float $discountAmount
    ) {}

    public function apply(float $totalAmount): float
    {
        return max(0, $totalAmount - $this->discountAmount);
    }

    public function name(): string
    {
        return "Diskon Potongan Rp " . number_format($this->discountAmount, 0, ',', '.');
    }
}
