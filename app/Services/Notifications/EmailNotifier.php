<?php

namespace App\Services\Notifications;

use App\Contracts\EmailNotifierInterface;
use Illuminate\Support\Facades\Log;

class EmailNotifier implements EmailNotifierInterface
{
    public function sendEmail(string $email, string $message): bool
    {
        Log::info("EMAIL SENT to {$email}: {$message}");
        return true;
    }
}
