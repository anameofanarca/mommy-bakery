<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code', 'customer_name', 'phone', 'email',
        'delivery_type', 'address', 'schedule_at', 'note',
        'subtotal', 'delivery_fee', 'total',
        'payment_method', 'status',
    ];

    protected $casts = ['schedule_at' => 'datetime'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
