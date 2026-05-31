<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'name', 'email', 'phone',
        'address', 'city', 'province', 'zip',
        'subtotal', 'shipping', 'total',
        'status', 'payment_method', 'notes'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}