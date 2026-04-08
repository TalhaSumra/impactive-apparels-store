<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorefrontOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_can_place_a_public_storefront_order(): void
    {
        $product = Product::query()->create([
            'accent' => '#1f5aa6',
            'available_sizes' => ['S', 'M', 'L'],
            'badge' => 'Featured Kit',
            'category' => 'Basketball Uniforms',
            'description' => 'Test product description for a storefront order.',
            'featured' => true,
            'highlights' => ['Custom graphics', 'Premium fabric'],
            'lead_time_days' => 10,
            'min_order_quantity' => 5,
            'name' => 'Storefront Test Kit',
            'preview_code' => '10',
            'price' => 14990,
            'secondary_accent' => '#d2a93a',
            'short_description' => 'Short storefront description.',
            'slug' => 'storefront-test-kit',
            'sport' => 'Basketball',
        ]);

        $this->post(route('cart.store'), [
            'product_id' => $product->id,
            'quantity' => 5,
            'size' => 'M',
        ])->assertStatus(303);

        $response = $this->post(route('checkout.store'), [
            'city' => 'Lahore',
            'country' => 'Pakistan',
            'customer_name' => 'Talha Sumra',
            'email' => 'talha@example.com',
            'order_notes' => 'Add team names and captain armband.',
            'payment_method' => 'whatsapp_confirmation',
            'phone' => '+923001112233',
            'shipping_address' => 'Model Town, Lahore',
            'team_name' => 'Impactive Squad',
        ]);

        $order = Order::query()->first();

        $response->assertRedirect(route('checkout.success', ['order' => $order->order_number], false));

        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Talha Sumra',
            'email' => 'talha@example.com',
            'item_count' => 5,
            'team_name' => 'Impactive Squad',
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_name' => 'Storefront Test Kit',
            'quantity' => 5,
            'size' => 'M',
        ]);
    }
}
