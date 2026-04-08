#!/usr/bin/env sh
set -e

cd /var/www/html

mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache

if [ -n "$RENDER_EXTERNAL_URL" ] && [ -z "$APP_URL" ]; then
    export APP_URL="$RENDER_EXTERNAL_URL"
fi

if [ -n "$APP_URL" ] && [ -z "$ASSET_URL" ]; then
    export ASSET_URL="$APP_URL"
fi

php artisan optimize:clear
php artisan config:cache
php artisan view:cache
php artisan migrate --force
php artisan db:seed --class=ProductSeeder --force

exec apache2-foreground
