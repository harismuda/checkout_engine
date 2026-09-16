<?php

namespace App\Services\Notifications;

use App\Contracts\SmsNotifierInterface;
use Illuminate\Support\Facades\Log;

class SmsNotifier implements SmsNotifierInterface
{
    public function sendSms(string $phoneNumber, string $message): bool
    {
        Log::info("SMS SENT to {$phoneNumber}: {$message}");
        return true;
    }
}
