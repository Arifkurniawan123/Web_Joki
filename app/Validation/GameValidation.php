<?php

namespace App\Validation;

class GameValidation
{
    public static function rules($gameId = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:games,name,' . $gameId],
            'slug'        => ['nullable', 'string', 'max:255', 'unique:games,slug,' . $gameId],
            'code'        => ['nullable', 'string', 'max:10'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'string', 'max:500'],
            'is_active'   => ['boolean'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required'      => 'Nama game wajib diisi.',
            'name.string'        => 'Nama game harus berupa teks.',
            'name.unique'        => 'Nama game sudah dipakai.',
            'name.max'           => 'Nama game maksimal 255 karakter.',
            'slug.unique'        => 'Slug sudah dipakai game lain.',
            'slug.max'           => 'Slug maksimal 255 karakter.',
            'code.max'           => 'Kode game maksimal 10 karakter.',
            'image.max'          => 'URL gambar maksimal 500 karakter.',
            'is_active.boolean'  => 'Status aktif harus berupa ya/tidak.',
            'sort_order.integer' => 'Urutan harus berupa angka.',
            'sort_order.min'     => 'Urutan tidak boleh negatif.',
        ];
    }
}