<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;

class BankTransferPayment implements PaymentGatewayInterface
{
    public function charge(float $amount, array $paymentDetails): array
    {
        $accountNumber = $paymentDetails['account_number'] ?? 'VA-12345678';

        return [
            'success' => true,
            'transaction_id' => 'TRX-BANK-' . uniqid(),
            'message' => "Pembayaran sebesar Rp " . number_format($amount, 0, ',', '.') . " via Bank Account {$accountNumber} berhasil."
        ];
    }
}
