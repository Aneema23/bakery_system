<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliveryPerson()
    {
        return $this->belongsTo(User::class, 'delivery_person_id');
    }

    protected $fillable = [
        'user_id',
        'delivery_person_id',
        'priority',
        'delivery_notes',
        'product_name',
        'customer_name',
        'phone',
        'address',
        'city',
        'cake_size',
        'flavor',
        'frosting',
        'cake_message',
        'special_notes',
        'delivery_date',
        'delivery_option',
        'design_image',
        'total_price',
        'advance_amount',
        'transaction_id',
        'payment_method',
        'card_type',
        'card_last_four',
        'status',
        'latitude',
        'longitude',
    ];
}
