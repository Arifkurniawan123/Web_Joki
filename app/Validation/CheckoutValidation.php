<?php

namespace App\Validation;

class CheckoutValidation
{
    public static function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'wa_number'     => ['required', 'string', 'max:20'],
            'notes'         => ['nullable', 'string', 'max:1000'],
        ];
    }

    public static function messages(): array
    {
        return [
            'customer_name.required' => 'Nama lengkap wajib diisi.',
            'customer_name.max'      => 'Nama maksimal 255 karakter.',
            'wa_number.required'     => 'Nomor WhatsApp wajib diisi.',
            'wa_number.max'          => 'Nomor WhatsApp maksimal 20 karakter.',
            'notes.max'              => 'Catatan maksimal 1000 karakter.',
        ];
    }
}