<?php

namespace Tests\Unit;

use App\Services\Discounts\BuyOneGetOneDiscount;
use App\Services\Discounts\DiscountCalculator;
use App\Services\Discounts\FixedDiscount;
use App\Services\Discounts\PercentageDiscount;
use PHPUnit\Framework\TestCase;

class DiscountTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_can_calculate_fixed_discount(): void
    {
        $calculator = new DiscountCalculator();
        $discount = new FixedDiscount(20000);

        $total = $calculator->calculate(100000, $discount);
        $this->assertEquals(80000, $total);
    }

    public function test_calculate_percentage_discount(): void
    {
        $calculator = new DiscountCalculator();
        $discount = new PercentageDiscount(10);

        $total = $calculator->calculate(100000, $discount);
        $this->assertEquals(90000, $total);
    }

    public function test_buyone_getone(): void
    {
        $buyOneGetOneDiscount = new BuyOneGetOneDiscount();

        $total = $buyOneGetOneDiscount->apply(100000);
        $this->assertEquals(50000, $total);
    }

    public function test_returns_original_amount_when_no_discount(): void
    {
        $calculator = new DiscountCalculator();

        $total = $calculator->calculate(100000, null);
        $this->assertEquals(100000, $total);
    }
}
