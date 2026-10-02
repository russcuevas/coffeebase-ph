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
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            
            // Matcha-specific attributes
            $table->string('grade')->nullable(); // e.g. Ceremonial, Premium, Daily
            $table->text('flavor_notes')->nullable(); // e.g. Creamy Umami • Sweet Pea • Fresh Greens • Mellow Finish
            $table->string('origin')->nullable(); // e.g. Uji, Kyoto
            $table->string('cultivar')->nullable(); // e.g. Samidori, Okumidori
            $table->string('harvest')->nullable(); // e.g. 1st Flush
            $table->string('milling')->nullable(); // e.g. Ball Mill, Stone Mill
            $table->string('picking')->nullable(); // e.g. Shears, Hand Picked
            $table->text('recommended_for')->nullable(); // e.g. Usucha, Matcha Latte
            $table->text('storage')->nullable(); // e.g. Keep refrigerated after opening. Avoid heat, light and humidity.

            // Media & Tags
            $table->string('primary_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('badge')->nullable(); // "Best Seller", "New", "Limited Reserve"
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
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
