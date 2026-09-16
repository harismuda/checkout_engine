<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    public function test_can_checkout_successfully_with_discount_and_ewallet(): void
    {
        $payload = [
            'amount' => 100000,
            'payment_method' => 'ewallet',
            'discount_type' => 'percentage',
            'discount_value' => 20, // diskon 20%
            'email' => 'customer@example.com',
            'phone' => '08123456789',
            'payment_details' => [
                'phone_number' => '08123456789'
            ]
        ];

        $response = $this->postJson('/api/checkout', $payload);

        $response->assertStatus(201)
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.original_amount', 100000)
            ->assertJsonPath('data.final_amount', 80000)
            ->assertJsonPath('data.discount_name', 'Diskon 20%');
    }
}
