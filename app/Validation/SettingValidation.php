<?php

namespace App\Validation;

class SettingValidation
{
    public static function rules(): array
    {
        return [
            'brand_name'  => ['required', 'string', 'max:255'],
            'wa_number'   => ['required', 'string', 'max:20'],
            'email'       => ['nullable', 'email', 'max:255'],
            'qris_image'  => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'instagram'   => ['nullable', 'string', 'max:100'],
            'tiktok'      => ['nullable', 'string', 'max:100'],
            'tagline'     => ['nullable', 'string', 'max:255'],
        ];
    }

    public static function messages(): array
    {
        return [
            'brand_name.required' => 'Nama brand wajib diisi.',
            'wa_number.required'  => 'Nomor WhatsApp wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
        ];
    }
}