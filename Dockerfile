FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader

COPY . .

RUN composer dump-autoload --optimize --no-dev

FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./

RUN npm ci

COPY . .

RUN npm run build

FROM php:8.3-apache-bookworm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y libpq-dev libzip-dev unzip && docker-php-ext-install pdo_pgsql pgsql zip && a2enmod rewrite && sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf && sed -ri 's!Listen 80!Listen 10000!g' /etc/apache2/ports.conf && sed -ri 's!<VirtualHost \\*:80>!<VirtualHost *:10000>!g' /etc/apache2/sites-available/000-default.conf && rm -rf /var/lib/apt/lists/*

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build
COPY scripts/render-start.sh /usr/local/bin/render-start

RUN chmod +x /usr/local/bin/render-start && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000

CMD ["render-start"]
