<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'category',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    const STATUS_DRAFT     = 'draft';
    const STATUS_PUBLISHED = 'published';

    public static function statuses(): array
    {
        return [
            self::STATUS_DRAFT     => 'Draft',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}