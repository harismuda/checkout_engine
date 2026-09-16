<?php

namespace App\Contracts;

interface SmsNotifierInterface
{
    public function sendSms(string $phoneNumber, string $message): bool;
}
