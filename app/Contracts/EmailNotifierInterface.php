<?php

namespace App\Contracts;

interface EmailNotifierInterface
{
    public function sendEmail(string $email, string $message): bool;
}
