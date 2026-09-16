<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;

class EWalletPayment implements PaymentGatewayInterface
{
    public function charge(float $amount, array $paymentDetails): array
    {
        $phoneNumber = $paymentDetails['phone_number'] ?? '08123456789';

        return [
            'success' => true,
            'transaction_id' => 'TRX-EWALL-' . uniqid(),
            'message' => "Pembayaran sebesar Rp " . number_format($amount, 0, ',', '.') . " via E-Wallet ({$phoneNumber}) berhasil."
        ];
    }
}
