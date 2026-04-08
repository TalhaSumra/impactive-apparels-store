<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'email',
        'phone',
        'team_name',
        'shipping_address',
        'city',
        'country',
        'payment_method',
        'status',
        'order_notes',
        'subtotal',
        'shipping_amount',
        'total',
        'item_count',
    ];

    protected function casts(): array
    {
        return [
            'shipping_amount' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
