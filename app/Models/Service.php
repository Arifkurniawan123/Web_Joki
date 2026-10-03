<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'name',
        'slug',
        'description',
        'price',
        'estimated_days',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}