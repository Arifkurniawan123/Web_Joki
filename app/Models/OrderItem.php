<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'service_id',
        'game_id',
        'price',
        'game_account_id',
        'game_email',       
        'game_password', 
        'game_username',
        'game_server',
        'notes',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'game_password' => 'encrypted',  
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}