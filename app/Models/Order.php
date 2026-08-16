<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_name',
        'customer_name',
        'phone',
        'address',
        'city',
        'postal_code',
        'cake_size',
        'flavor',
        'frosting',
        'cake_message',
        'special_notes',
        'delivery_date',
        'delivery_option',
        'design_image',
        'total_price',
        'status',
    ];
}
