<?php

namespace App\Support;

class StorefrontImageCatalog
{
    public static function productImage(string $slug): ?string
    {
        $images = [
            'all-star-baseball-package' => 'images/storefront/products/all-star-baseball-package.png',
            'bucks-club-uniform-bundle' => 'images/storefront/products/bucks-club-uniform-bundle.png',
            'celtics-night-performance-kit' => 'images/storefront/products/celtics-night-performance-kit.png',
            'eagles-pro-football-package' => 'images/storefront/products/eagles-pro-football-package.png',
            'patriot-custom-hoodie' => 'images/storefront/products/patriot-custom-hoodie.png',
            'redline-soccer-match-kit' => 'images/storefront/products/redline-soccer-match-kit.png',
            'volt-performance-training-set' => 'images/storefront/products/volt-performance-training-set.png',
            'warriors-elite-basketball-set' => 'images/storefront/products/warriors-elite-basketball-set.png',
        ];

        $path = $images[$slug] ?? null;

        if (!$path) {
            return null;
        }

        foreach ([public_path($path), dirname(base_path()).DIRECTORY_SEPARATOR.$path] as $absolutePath) {
            if (file_exists($absolutePath)) {
                return '/'.$path;
            }
        }

        $jpgPath = preg_replace('/\.png$/', '.jpg', $path);

        if ($jpgPath) {
            foreach ([public_path($jpgPath), dirname(base_path()).DIRECTORY_SEPARATOR.$jpgPath] as $absolutePath) {
                if (file_exists($absolutePath)) {
                    return '/'.$jpgPath;
                }
            }
        }

        return null;
    }
}
