<?php

namespace App\Validation;

use Illuminate\Validation\Rule;

class ServiceValidation
{
    public static function rules($serviceId = null): array
    {
        return [
            'game_id'        => ['required', 'exists:games,id'],
            'name'           => ['required', 'string', 'max:255'],
            'slug'           => ['nullable', 'string', 'max:255', Rule::unique('services', 'slug')->ignore($serviceId)],
            'description'    => ['nullable', 'string'],
            'price'          => ['required', 'numeric', 'min:0'],
            'estimated_days' => ['nullable', 'string', 'max:50'],
            'image'          => ['nullable', 'string', 'max:500'],
            'is_active'      => ['boolean'],
            'sort_order'     => ['nullable', 'integer', 'min:0']
        ];
    }

    public static function messages(): array
    {
        return [
            'game_id.required'         => 'Game wajib dipilih.',
            'game_id.exists'           => 'Game tidak ditemukan.',
            'name.required'            => 'Nama service wajib diisi.',
            'slug.unique'              => 'Slug sudah dipakai service lain.',
            'price.required'           => 'Harga wajib diisi.',
            'price.numeric'            => 'Harga harus berupa angka.',
            'price.min'                => 'Harga tidak boleh negatif.',
        ];
    }
}