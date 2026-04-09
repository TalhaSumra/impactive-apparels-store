<?php

namespace App\Support;

use App\Models\Product;

class ProductPresenter
{
    public static function make(Product $product): array
    {
        return [
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->name,
            'category' => $product->category,
            'sport' => $product->sport,
            'short_description' => $product->short_description,
            'description' => $product->description,
            'price' => (float) $product->price,
            'badge' => $product->badge,
            'accent' => $product->accent,
            'secondary_accent' => $product->secondary_accent,
            'preview_code' => $product->preview_code,
            'featured' => $product->featured,
            'lead_time_days' => $product->lead_time_days,
            'min_order_quantity' => $product->min_order_quantity,
            'available_sizes' => $product->available_sizes ?? [],
            'highlights' => $product->highlights ?? [],
            'image' => StorefrontImageCatalog::productImage($product->slug),
        ];
    }
}
