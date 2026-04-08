# Impactive Apparels Store

Impactive Apparels Store is a Laravel ecommerce website for a custom sportswear brand. It includes a modern public storefront, product catalog, cart, checkout flow, order storage, and a deployment setup for Render.

## Stack

- PHP 8.3
- Laravel 13
- Inertia.js
- Vue 3
- Tailwind CSS
- SQLite for local development
- PostgreSQL for production deployment

## Features

- Custom sportswear storefront homepage
- Product catalog with category and sport-focused browsing
- Product detail pages
- Session-based shopping cart
- Guest checkout flow
- Order and order item persistence
- Seeded starter catalog for team uniforms, training sets, and fanwear
- Authentication scaffolding for admin/account expansion
- Render deployment configuration with Docker

## Main Application Areas

- Storefront routes: [routes/web.php](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/routes/web.php)
- Public controllers: [app/Http/Controllers/StorefrontController.php](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/app/Http/Controllers/StorefrontController.php), [app/Http/Controllers/CartController.php](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/app/Http/Controllers/CartController.php), [app/Http/Controllers/CheckoutController.php](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/app/Http/Controllers/CheckoutController.php)
- Storefront pages: [resources/js/Pages/Storefront](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/resources/js/Pages/Storefront)
- Shared store layout: [resources/js/Layouts/StoreLayout.vue](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/resources/js/Layouts/StoreLayout.vue)
- Catalog data: [database/seeders/ProductSeeder.php](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/database/seeders/ProductSeeder.php)
- Production boot script: [scripts/render-start.sh](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/scripts/render-start.sh)
- Render blueprint: [render.yaml](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/render.yaml)

## Local Development

1. Install PHP, Composer, Node.js, and npm.
2. Install dependencies:

```bash
composer install
npm install
```

3. Copy environment file and generate the app key:

```bash
cp .env.example .env
php artisan key:generate
```

4. Create the local database and run migrations with seed data:

```bash
touch database/database.sqlite
php artisan migrate --seed
```

5. Start the app:

```bash
php artisan serve
npm run dev
```

6. Open `http://127.0.0.1:8000`.

## Useful Commands

```bash
php artisan migrate --seed
php artisan test
npm run build
```

## Production Deployment

This project is prepared for deployment on Render using Docker and PostgreSQL.

- Docker image definition: [Dockerfile](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/Dockerfile)
- Render service and database config: [render.yaml](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/render.yaml)
- Startup tasks: migration, cache prep, and product seeding in [scripts/render-start.sh](/Users/talhasumra/Data/Programming/AppTechnologies/website-dev/scripts/render-start.sh)

During startup the production container:

- prepares writable Laravel directories
- caches config and views
- runs migrations
- seeds the product catalog
- starts Apache on Render’s expected port

## Current Status

The project is ready for:

- public storefront browsing
- cart and checkout flow
- database-backed order capture
- Render deployment

The project does not yet include:

- online payment gateway integration
- admin product management panel
- live shipping calculation
- email notification workflow

## Repository

GitHub repository: [TalhaSumra/impactive-apparels-store](https://github.com/TalhaSumra/impactive-apparels-store)
