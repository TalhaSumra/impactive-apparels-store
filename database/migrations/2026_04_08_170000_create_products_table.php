<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('category');
            $table->string('sport');
            $table->text('short_description');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('badge')->nullable();
            $table->string('accent', 20);
            $table->string('secondary_accent', 20);
            $table->string('preview_code', 8)->default('00');
            $table->boolean('featured')->default(false);
            $table->unsignedSmallInteger('lead_time_days')->default(10);
            $table->unsignedInteger('min_order_quantity')->default(1);
            $table->json('available_sizes')->nullable();
            $table->json('highlights')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
