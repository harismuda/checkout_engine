<?php

namespace App\Contracts;

interface DiscountStrategyInterface
{
    public function apply(float $totalAmount): float;
    public function name(): string;
}
