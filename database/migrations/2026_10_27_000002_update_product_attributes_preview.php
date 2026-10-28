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
        // 1. Fukuoka Yame Yabukita
        DB::table('products')
            ->where('name', 'LIKE', '%Yabukita%')
            ->orWhere('slug', 'LIKE', '%yabukita%')
            ->update([
                'origin' => 'Yame',
                'grade' => 'Ceremonial grade',
                'type' => 'Single Origin',
            ]);

        // 2. Uji Hikari (also matches Uli Hikari)
        DB::table('products')
            ->where('name', 'LIKE', '%Hikari%')
            ->orWhere('slug', 'LIKE', '%hikari%')
            ->update([
                'origin' => 'Uji',
                'grade' => 'Ceremonial grade',
                'type' => 'Single Origin',
            ]);

        // 3. Uji Samidori
        DB::table('products')
            ->where('name', 'LIKE', '%Samidori%')
            ->orWhere('slug', 'LIKE', '%samidori%')
            ->update([
                'origin' => 'Uji',
                'grade' => 'Ceremonial grade',
                'type' => 'Single Origin',
            ]);

        // 4. Barista Nutty Blend
        DB::table('products')
            ->where('name', 'LIKE', '%Nutty%')
            ->orWhere('slug', 'LIKE', '%nutty%')
            ->update([
                'origin' => 'Aichi, Kagoshima, Kyoto',
                'grade' => 'Ceremonial Latte Grade',
                'type' => 'Blend',
            ]);

        // 5. Barista Blend (excluding Nutty)
        DB::table('products')
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%Barista Blend%')
                  ->orWhere('slug', 'barista-blend');
            })
            ->where('name', 'NOT LIKE', '%Nutty%')
            ->update([
                'origin' => 'Kagoshima, Aichi, Kyoto',
                'grade' => 'Ceremonial Latte Grade',
                'type' => 'Blend',
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

