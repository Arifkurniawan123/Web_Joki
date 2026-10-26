<?php

namespace App\Validation;

class AccountValidation
{
    public static function rules(): array
    {
        return [
            'game_email'      => ['required', 'array'],
            'game_email.*'    => ['required', 'string', 'max:255'],
            'game_password'   => ['required', 'array'],
            'game_password.*' => ['required', 'string', 'max:255'],
            'game_server'     => ['required', 'array'],
            'game_server.*'   => ['required', 'string', 'max:100'],
        ];
    }

    public static function messages(): array
    {
        return [
            'game_email.required'      => 'Email/Username wajib diisi.',
            'game_email.*.required'    => 'Semua kolom email/username harus diisi.',
            'game_password.required'   => 'Password wajib diisi.',
            'game_password.*.required' => 'Semua kolom password harus diisi.',
            'game_server.required'     => 'Data server wajib diisi.',         // ← Tambahan
            'game_server.*.required'   => 'Nama server harus diisi.',
            'game_server.*.max'        => 'Nama server maksimal 100 karakter.', // ← Tambahan biar lengkap
        ];
    }
}