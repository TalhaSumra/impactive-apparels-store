<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Support\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class CheckoutController extends Controller
{
    public function index(): Response|RedirectResponse
    {
        $cart = Cart::summary();

        if ($cart['count'] === 0) {
            return redirect()->route('shop.index')->with('success', 'Add products to your cart to start checkout.');
        }

        return Inertia::render('Storefront/Checkout', [
            'cart' => $cart,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = Cart::summary();

        if ($cart['count'] === 0) {
            return redirect()->route('shop.index')->with('success', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'city' => ['required', 'string', 'max:120'],
            'country' => ['required', 'string', 'max:120'],
            'customer_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'order_notes' => ['nullable', 'string', 'max:1000'],
            'payment_method' => ['required', Rule::in(['bank_transfer', 'cash_on_delivery', 'whatsapp_confirmation'])],
            'phone' => ['required', 'string', 'max:60'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'team_name' => ['nullable', 'string', 'max:255'],
        ]);

        $order = DB::transaction(function () use ($cart, $validated) {
            $order = Order::query()->create([
                'city' => $validated['city'],
                'country' => $validated['country'],
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'item_count' => $cart['count'],
                'order_notes' => $validated['order_notes'] ?? null,
                'order_number' => $this->generateOrderNumber(),
                'payment_method' => $validated['payment_method'],
                'phone' => $validated['phone'],
                'shipping_address' => $validated['shipping_address'],
                'shipping_amount' => 0,
                'status' => 'pending',
                'subtotal' => $cart['subtotal'],
                'team_name' => $validated['team_name'] ?? null,
                'total' => $cart['subtotal'],
            ]);

            foreach ($cart['items'] as $item) {
                $order->items()->create([
                    'line_total' => $item['line_total'],
                    'product_id' => $item['product']['id'],
                    'product_name' => $item['product']['name'],
                    'quantity' => $item['quantity'],
                    'size' => $item['size'],
                    'sport' => $item['product']['sport'],
                    'unit_price' => $item['unit_price'],
                ]);
            }

            return $order->load('items');
        });

        Cart::clear();

        return redirect()->route('checkout.success', $order->order_number)->with('success', 'Order placed successfully.');
    }

    public function success(Order $order): Response
    {
        return Inertia::render('Storefront/Success', [
            'order' => [
                'city' => $order->city,
                'country' => $order->country,
                'customer_name' => $order->customer_name,
                'email' => $order->email,
                'item_count' => $order->item_count,
                'items' => $order->items->map(function ($item) {
                    return [
                        'line_total' => (float) $item->line_total,
                        'product_name' => $item->product_name,
                        'quantity' => $item->quantity,
                        'size' => $item->size,
                        'sport' => $item->sport,
                        'unit_price' => (float) $item->unit_price,
                    ];
                })->values(),
                'order_notes' => $order->order_notes,
                'order_number' => $order->order_number,
                'payment_method' => $order->payment_method,
                'phone' => $order->phone,
                'shipping_address' => $order->shipping_address,
                'status' => $order->status,
                'subtotal' => (float) $order->subtotal,
                'team_name' => $order->team_name,
                'total' => (float) $order->total,
            ],
        ]);
    }

    protected function generateOrderNumber(): string
    {
        do {
            $orderNumber = 'IA-'.now()->format('ymd').'-'.Str::upper(Str::random(5));
        } while (Order::query()->where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }
}
