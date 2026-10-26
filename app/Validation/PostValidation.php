<?php

namespace App\Validation;

use Illuminate\Validation\Rule;

class PostValidation
{
    public static function rules($postId = null): array
    {
        return [
            'title'     => ['required', 'string', 'max:255'],
            'slug'      => ['nullable', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($postId)],
            'excerpt'   => ['nullable', 'string', 'max:500'],
            'content'   => ['required', 'string'],
            'thumbnail' => ['nullable', 'string', 'max:500'],
            'category'  => ['nullable', 'string', 'max:100'],
            'status'    => ['required', 'in:draft,published'],
        ];
    }

    public static function messages(): array
    {
        return [
            'title.required'   => 'Judul post wajib diisi.',
            'title.max'        => 'Judul post maksimal 255 karakter.',
            'slug.unique'      => 'Slug sudah dipakai post lain.',
            'content.required' => 'Konten wajib diisi.',
            'status.required'  => 'Status wajib dipilih.',
            'status.in'        => 'Status harus berupa draft atau published.',
        ];
    }
}