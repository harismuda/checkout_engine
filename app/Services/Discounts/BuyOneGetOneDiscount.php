<?php

namespace App\Services\Discounts;

use App\Contracts\DiscountStrategyInterface;

class BuyOneGetOneDiscount implements DiscountStrategyInterface
{
    private int $buyQuantity = 1;
    private int $getQuantity = 1;

    /**
     * Create a new class instance.
     */
    public function __construct(
        private int $itemCount = 2
    ) {}

    public function apply(float $totalAmount): float
    {
        if ($this->itemCount >= $this->buyQuantity + $this->getQuantity) {
            $freeItems = floor($this->itemCount / ($this->buyQuantity + $this->getQuantity)) * $this->getQuantity;
            $discountedAmount = $freeItems * ($totalAmount / $this->itemCount);
            return max(0, $totalAmount - $discountedAmount);
        }
        return $totalAmount;
    }

    public function name(): string
    {
        return "Buy {$this->buyQuantity} Get {$this->getQuantity} Free";
    }
}
