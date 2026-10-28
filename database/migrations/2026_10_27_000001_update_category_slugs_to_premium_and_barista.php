<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update single-origin categories to 'premium'
        DB::table('categories')
            ->where('slug', 'single-origin-matcha')
            ->orWhere('slug', 'singles-origin')
            ->orWhere('slug', 'single-origin')
            ->orWhere('name', 'LIKE', '%single%origin%')
            ->update([
                'slug' => 'premium',
                'name' => 'Premium',
            ]);

        // Update matcha-blends categories to 'barista'
        DB::table('categories')
            ->where('slug', 'matcha-blends')
            ->orWhere('slug', 'blends')
            ->orWhere('name', 'LIKE', '%matcha%blend%')
            ->update([
                'slug' => 'barista',
                'name' => 'Barista',
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categories')
            ->where('slug', 'premium')
            ->update([
                'slug' => 'single-origin-matcha',
                'name' => 'Single Origin Matcha',
            ]);

        DB::table('categories')
            ->where('slug', 'barista')
            ->update([
                'slug' => 'matcha-blends',
                'name' => 'Matcha Blends',
            ]);
    }
};

