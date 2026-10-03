<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'customer_name',
        'wa_number',
        'total_price',
        'payment_proof',
        'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
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

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getRouteKeyName(): string
    {
        return 'order_code';
    }
}