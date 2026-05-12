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

            $table->string('order_code')->unique();

            $table->string('customer_name');
            $table->string('phone', 30);
            $table->string('email')->nullable();

            $table->enum('delivery_type', ['pickup', 'delivery'])->default('pickup');
            $table->text('address')->nullable();
            $table->timestamp('schedule_at')->nullable();
            $table->text('note')->nullable();

            $table->unsignedBigInteger('subtotal')->default(0);
            $table->unsignedBigInteger('delivery_fee')->default(0);
            $table->unsignedBigInteger('total')->default(0);

            $table->string('payment_method')->default('transfer'); // transfer / qris_simulation
            $table->string('status')->default('pending_payment'); // pending_payment/paid/processing/completed/cancelled

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
