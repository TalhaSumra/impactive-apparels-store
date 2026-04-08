<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Cart;
use App\Support\ProductPresenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    public function destroy(string $itemKey): RedirectResponse
    {
        abort_unless(Cart::has($itemKey), 404);

        Cart::remove($itemKey);

        return back(303)->with('success', 'Item removed from cart.');
    }

    public function index(): Response
    {
        return Inertia::render('Storefront/Cart', [
            'cart' => Cart::summary(),
            'recommendedProducts' => Product::query()
                ->where('featured', true)
                ->orderBy('name')
                ->take(3)
                ->get()
                ->map(fn(Product $product) => ProductPresenter::make($product))
                ->values(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $product = Product::query()->findOrFail((int) $request->input('product_id'));

        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:'.$product->min_order_quantity, 'max:200'],
            'size' => ['required', 'string', Rule::in($product->available_sizes ?? [])],
        ]);

        Cart::add($product, (int) $validated['quantity'], (string) $validated['size']);

        return back(303)->with('success', $product->name.' was added to your cart.');
    }

    public function update(Request $request, string $itemKey): RedirectResponse
    {
        abort_unless(Cart::has($itemKey), 404);

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:200'],
        ]);

        Cart::update($itemKey, (int) $validated['quantity']);

        return back(303)->with('success', 'Cart updated.');
    }
}
