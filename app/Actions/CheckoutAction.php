<?php

namespace App\Actions;

use App\Contracts\EmailNotifierInterface;
use App\Contracts\PaymentGatewayInterface;
use App\Contracts\SmsNotifierInterface;
use App\Services\Discounts\DiscountCalculator;
use App\Services\Discounts\FixedDiscount;
use App\Services\Discounts\PercentageDiscount;
use App\Services\Payments\BankTransferPayment;
use App\Services\Payments\EWalletPayment;

class CheckoutAction
{
    public function __construct(
        private DiscountCalculator $discountCalculator,
        private EmailNotifierInterface $emailNotifier,
        private SmsNotifierInterface $smsNotifier
    ) {}

    public function execute(array $data): array
    {
        $originalAmount = (float) $data['amount'];

        // 1. Tentukan strategi diskon (OCP)
        $discountStrategy = null;
        if (($data['discount_type'] ?? null) === 'fixed') {
            $discountStrategy = new FixedDiscount((float) $data['discount_value']);
        } elseif (($data['discount_type'] ?? null) === 'percentage') {
            $discountStrategy = new PercentageDiscount((float) $data['discount_value']);
        }

        // 2. Hitung total biaya setelah diskon
        $finalAmount = $this->discountCalculator->calculate($originalAmount, $discountStrategy);

        // 3. Pilihkah Payment Gateway (LSP & DIP)
        /** @var PaymentGatewayInterface $gateway */
        $gateway = match ($data['payment_method']) {
            'bank_transfer' => new BankTransferPayment(),
            'ewallet' => new EWalletPayment(),
            default => throw new \InvalidArgumentException("Metode pembayaran tidak valid")
        };

        // 4. Eksekusi Pembayaran
        $paymentResult = $gateway->charge($finalAmount, $data['payment_details'] ?? []);

        // 5. Kirim Notifikasi (ISP)
        if ($paymentResult['success']) {
            $message = "Checkout berhasil! ID Transaksi: {$paymentResult['transaction_id']}. Total: Rp " . number_format($finalAmount, 0, ',', '.');
            $this->emailNotifier->sendEmail($data['email'], $message);
            $this->smsNotifier->sendSms($data['phone'], $message);
        }

        return [
            'original_amount' => $originalAmount,
            'final_amount' => $finalAmount,
            'discount_name' => $discountStrategy?->name() ?? 'Tanpa Diskon',
            'payment' => $paymentResult
        ];
    }
}
