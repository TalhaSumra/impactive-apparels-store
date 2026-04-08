<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'category',
        'sport',
        'short_description',
        'description',
        'price',
        'badge',
        'accent',
        'secondary_accent',
        'preview_code',
        'featured',
        'lead_time_days',
        'min_order_quantity',
        'available_sizes',
        'highlights',
    ];

    protected function casts(): array
    {
        return [
            'available_sizes' => 'array',
            'featured' => 'boolean',
            'highlights' => 'array',
            'price' => 'decimal:2',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
