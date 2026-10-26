<?php

namespace App\Validation;

use App\Models\Order;
use Illuminate\Validation\Rule;

class OrderValidation
{
    public static function rules(): array
    {
        return [
            // Status wajib diisi dan harus salah satu dari status yang ada di Model Order
            'status' => [
                'required', 
                'string', 
                Rule::in(array_keys(Order::statuses()))
            ],
        ];
    }

    public static function messages(): array
    {
        return [
            'status.required' => 'Status order wajib dipilih.',
            'status.in'       => 'Status order tidak valid.',
        ];
    }
}