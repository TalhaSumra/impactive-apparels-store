<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\ProductPresenter;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StorefrontController extends Controller
{
    public function catalog(Request $request): Response
    {
        $filters = [
            'category' => trim((string) $request->input('category', '')),
            'search' => trim((string) $request->input('search', '')),
            'sort' => trim((string) $request->input('sort', 'featured')),
            'sport' => trim((string) $request->input('sport', '')),
        ];

        $productsQuery = Product::query()
            ->when($filters['category'] !== '', function ($query) use ($filters) {
                $query->where('category', $filters['category']);
            })
            ->when($filters['search'] !== '', function ($query) use ($filters) {
                $query->where(function ($innerQuery) use ($filters) {
                    $innerQuery
                        ->where('name', 'like', '%'.$filters['search'].'%')
                        ->orWhere('short_description', 'like', '%'.$filters['search'].'%')
                        ->orWhere('sport', 'like', '%'.$filters['search'].'%');
                });
            })
            ->when($filters['sport'] !== '', function ($query) use ($filters) {
                $query->where('sport', $filters['sport']);
            });

        if ($filters['sort'] === 'price_asc') {
            $productsQuery->orderBy('price')->orderBy('name');
        } elseif ($filters['sort'] === 'price_desc') {
            $productsQuery->orderByDesc('price')->orderBy('name');
        } elseif ($filters['sort'] === 'name_asc') {
            $productsQuery->orderBy('name');
        } else {
            $productsQuery->orderByDesc('featured')->orderBy('name');
        }

        $products = $productsQuery
            ->get()
            ->map(fn(Product $product) => ProductPresenter::make($product))
            ->values();

        return Inertia::render('Storefront/Catalog', [
            'categories' => Product::query()->select('category')->distinct()->orderBy('category')->pluck('category')->values(),
            'filters' => $filters,
            'products' => $products,
            'sports' => Product::query()->select('sport')->distinct()->orderBy('sport')->pluck('sport')->values(),
        ]);
    }

    public function home(): Response
    {
        $allProducts = Product::query()
            ->orderByDesc('featured')
            ->orderBy('name')
            ->get();

        $collections = $allProducts
            ->groupBy('category')
            ->map(function ($group, $category) {
                $anchor = $group->first();

                return [
                    'accent' => $anchor->accent,
                    'category' => $category,
                    'count' => $group->count(),
                    'secondary_accent' => $anchor->secondary_accent,
                    'sports' => $group->pluck('sport')->unique()->values(),
                    'starting_price' => (float) $group->min('price'),
                ];
            })
            ->values();

        return Inertia::render('Storefront/Home', [
            'collections' => $collections,
            'featuredProducts' => $allProducts
                ->where('featured', true)
                ->take(6)
                ->map(fn(Product $product) => ProductPresenter::make($product))
                ->values(),
            'latestProducts' => $allProducts
                ->take(8)
                ->map(fn(Product $product) => ProductPresenter::make($product))
                ->values(),
        ]);
    }

    public function show(Product $product): Response
    {
        $relatedProducts = Product::query()
            ->whereKeyNot($product->id)
            ->where('sport', $product->sport)
            ->orderByDesc('featured')
            ->orderBy('name')
            ->take(3)
            ->get()
            ->map(fn(Product $relatedProduct) => ProductPresenter::make($relatedProduct))
            ->values();

        return Inertia::render('Storefront/Product', [
            'product' => ProductPresenter::make($product),
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
