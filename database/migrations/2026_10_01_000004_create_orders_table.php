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
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            
            // Customer Info & Shipping Address
            $table->string('customer_first_name');
            $table->string('customer_last_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('company')->nullable();
            $table->string('country')->default('Philippines');
            $table->text('address');
            $table->string('apartment')->nullable();
            $table->string('barangay');
            $table->string('city');
            $table->string('postal_code');
            $table->string('region');

            // Amounts
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);

            // Payment & Status
            $table->string('payment_method')->default('Cash on Delivery');
            $table->string('payment_status')->default('pending'); // 'pending', 'paid', 'refunded'
            $table->string('status')->default('pending'); // 'pending', 'preparing', 'out_for_delivery', 'delivered', 'cancelled'
            
            // Live Tracking Link
            $table->string('tracking_courier')->nullable(); // e.g. Lalamove, Grab Express, J&T
            $table->text('tracking_link')->nullable(); // Real-time delivery URL updated by admin
            $table->text('customer_notes')->nullable();
            $table->text('admin_notes')->nullable();

            // Status Timestamps
            $table->timestamp('preparing_at')->nullable();
            $table->timestamp('out_for_delivery_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

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
