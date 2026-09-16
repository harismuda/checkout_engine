<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:1000',
            'payment_method' => 'required|string|in:bank_transfer,ewallet',
            'discount_type' => 'nullable|string|in:fixed,percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'email' => 'required|email',
            'phone' => 'required|string',
            'payment_details' => 'nullable|array',
        ];
    }
}
