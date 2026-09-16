<?php

namespace Tests\Unit;

use App\Contracts\PaymentGatewayInterface;
use App\Services\Payments\BankTransferPayment;
use App\Services\Payments\CreditCardPayment;
use App\Services\Payments\EWalletPayment;
use PHPUnit\Framework\TestCase;

class PaymentGatewayTest extends TestCase
{
    private function processPayment(PaymentGatewayInterface $gateway, float $amount, array $details): array
    {
        return $gateway->charge($amount, $details);
    }

    public function test_bank_transfer_payment_conforms_to_contract(): void
    {
        $gateway = new BankTransferPayment();
        $result = $this->processPayment($gateway, 50000, ['account_number' => '123456']);

        $this->assertTrue($result['success']);
        $this->assertStringStartsWith('TRX-BANK-', $result['transaction_id']);
        $this->assertArrayHasKey('message', $result);
    }

    public function test_ewallet_payment_conforms_to_contract(): void
    {
        $gateway = new EWalletPayment();
        $result = $this->processPayment($gateway, 50000, ['phone_number' => '08129999']);

        $this->assertTrue($result['success']);
        $this->assertStringStartsWith('TRX-EWALL-', $result['transaction_id']);
        $this->assertArrayHasKey('message', $result);
    }

    public function test_credit_card_payment_conforms_to_contract(): void
    {
        $gateway = new CreditCardPayment();
        $result = $this->processPayment($gateway, 150000, ['card_number' => '4111111111111111']);

        $this->assertTrue($result['success']);
        $this->assertStringStartsWith('TRX-CC-', $result['transaction_id']);
        $this->assertArrayHasKey('message', $result);
    }
}
