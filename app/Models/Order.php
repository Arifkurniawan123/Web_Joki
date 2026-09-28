<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'game_id',
        'service_id',
        'customer_name',
        'wa_number',
        'game_account_id',
        'game_username',
        'game_server',
        'notes',
        'price',
        'payment_proof',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_PAID    = 'paid';
    const STATUS_PROCESS = 'process';
    const STATUS_DONE    = 'done';
    const STATUS_CANCEL  = 'cancel';

    public static function statuses(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PAID    => 'Sudah Bayar',
            self::STATUS_PROCESS => 'Diproses',
            self::STATUS_DONE    => 'Selesai',
            self::STATUS_CANCEL  => 'Dibatalkan',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'order_code';
    }
}