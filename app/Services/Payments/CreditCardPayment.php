<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;

class CreditCardPayment implements PaymentGatewayInterface
{
    /**
     * Create a new class instance.
     */
    public function charge(float $amount, array $paymentDetails): array
    {
        $cardNumber = $paymentDetails['card_number'] ?? '4111111111111111';
        
        return [
            'success' => true,
            'transaction_id' => 'TRX-CC-' . uniqid(),
            'message' => "Pembayaran sebesar Rp " . number_format($amount, 0, ',', '.') . " via Kartu Kredit ({$cardNumber}) berhasil."
        ];
    }
}
