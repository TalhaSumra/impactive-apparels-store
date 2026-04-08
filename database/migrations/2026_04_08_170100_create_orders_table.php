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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone');
            $table->string('team_name')->nullable();
            $table->text('shipping_address');
            $table->string('city');
            $table->string('country');
            $table->string('payment_method');
            $table->string('status')->default('pending');
            $table->text('order_notes')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping_amount', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->unsignedInteger('item_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
