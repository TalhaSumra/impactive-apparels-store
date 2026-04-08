<?php

namespace App\Http\Controllers;

use Database\Seeders\ProductSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response;

class InstallerController extends Controller
{
    /**
     * Run the installer for hosts without shell access.
     */
    public function __invoke(Request $request, string $token): Response
    {
        if (! config('setup.enabled')) {
            abort(404);
        }

        if (! hash_equals((string) config('setup.token'), $token)) {
            abort(404);
        }

        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--class' => ProductSeeder::class, '--force' => true]);

        return response(implode("\n\n", [
            'Setup completed.',
            trim(Artisan::output()),
            'Set SETUP_ENABLED=false in your .env file after this finishes.',
        ]), 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
