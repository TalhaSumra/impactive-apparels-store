<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Cart
{
    public const SESSION_KEY = 'store.cart.items';

    public static function add(Product $product, int $quantity, string $size): void
    {
        $cart = Session::get(self::SESSION_KEY, []);
        $normalizedSize = strtoupper($size);
        $key = self::itemKey($product->id, $normalizedSize);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'size' => $normalizedSize,
            ];
        }

        Session::put(self::SESSION_KEY, $cart);
    }

    public static function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    public static function contents(): Collection
    {
        $rows = collect(Session::get(self::SESSION_KEY, []));

        if ($rows->isEmpty()) {
            return collect();
        }

        $products = Product::query()
            ->whereIn('id', $rows->pluck('product_id'))
            ->get()
            ->keyBy('id');

        return $rows->map(function (array $row, string $key) use ($products) {
            $product = $products->get($row['product_id']);

            if (! $product) {
                return null;
            }

            $quantity = (int) $row['quantity'];
            $unitPrice = (float) $product->price;

            return [
                'key' => $key,
                'line_total' => (float) round($unitPrice * $quantity, 2),
                'product' => ProductPresenter::make($product),
                'quantity' => $quantity,
                'size' => $row['size'],
                'unit_price' => $unitPrice,
            ];
        })->filter()->values();
    }

    public static function has(string $itemKey): bool
    {
        return array_key_exists($itemKey, Session::get(self::SESSION_KEY, []));
    }

    public static function remove(string $itemKey): void
    {
        $cart = Session::get(self::SESSION_KEY, []);

        unset($cart[$itemKey]);

        Session::put(self::SESSION_KEY, $cart);
    }

    public static function summary(): array
    {
        $items = self::contents();

        return [
            'count' => (int) $items->sum('quantity'),
            'items' => $items->all(),
            'subtotal' => (float) round($items->sum('line_total'), 2),
        ];
    }

    public static function update(string $itemKey, int $quantity): void
    {
        $cart = Session::get(self::SESSION_KEY, []);

        if (! isset($cart[$itemKey])) {
            return;
        }

        if ($quantity <= 0) {
            unset($cart[$itemKey]);
        } else {
            $cart[$itemKey]['quantity'] = $quantity;
        }

        Session::put(self::SESSION_KEY, $cart);
    }

    protected static function itemKey(int $productId, string $size): string
    {
        return $productId.'-'.Str::slug($size);
    }
}
