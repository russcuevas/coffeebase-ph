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
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%Yabukita%')
                  ->orWhere('slug', 'LIKE', '%yabukita%');
            })
            ->update([
                'origin' => 'Yame',
                'grade' => 'Ceremonial grade',
                'type' => 'Single Origin',
            ]);

        // 2. Uli Hikari / Uji Hikari
        DB::table('products')
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%Hikari%')
                  ->orWhere('slug', 'LIKE', '%hikari%');
            })
            ->update([
                'origin' => 'Uji',
                'grade' => 'Ceremonial grade',
                'type' => 'Single Origin',
            ]);

        // 3. Uji Samidori
        DB::table('products')
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%Samidori%')
                  ->orWhere('slug', 'LIKE', '%samidori%');
            })
            ->update([
                'origin' => 'Uji',
                'grade' => 'Ceremonial grade',
                'type' => 'Single Origin',
            ]);

        // 4. Barista Nutty Blend
        DB::table('products')
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%Barista Nutty%')
                  ->orWhere('slug', 'LIKE', '%barista-nutty%');
            })
            ->update([
                'origin' => 'Aichi, Kagoshima, Kyoto',
                'grade' => 'Ceremonial Latte grade',
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
                'grade' => 'Ceremonial Latte grade',
                'type' => 'Blend',
            ]);

        // 6. Ren
        DB::table('products')
            ->where(function ($q) {
                $q->where('name', 'LIKE', 'Ren%')
                  ->orWhere('slug', 'ren');
            })
            ->update([
                'origin' => 'Kagoshima',
                'grade' => 'Ceremonial Grade',
                'type' => 'Blend',
            ]);

        // 7. Kirishima / Kirishima Blend
        DB::table('products')
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%Kirishima%')
                  ->orWhere('slug', 'LIKE', '%kirishima%');
            })
            ->update([
                'origin' => 'Kagoshima',
                'grade' => 'Ceremonial Grade',
                'type' => 'Blend',
            ]);

        // 8. Premium Nutty Blend
        DB::table('products')
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%Premium Nutty%')
                  ->orWhere('slug', 'LIKE', '%premium-nutty%');
            })
            ->update([
                'origin' => 'Aichi, Kagoshima, Kyoto',
                'grade' => 'Ceremonial Grade',
                'type' => 'Blend',
            ]);

        // 9. Extra Nutty Blend
        DB::table('products')
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%Extra Nutty%')
                  ->orWhere('slug', 'LIKE', '%extra-nutty%');
            })
            ->update([
                'origin' => 'Aichi, Kagoshima, Kyoto',
                'grade' => 'Ceremonial Grade',
                'type' => 'Blend',
            ]);

        // 10. Hojica dark roast
        DB::table('products')
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%Hojic%')
                  ->orWhere('slug', 'LIKE', '%hojic%');
            })
            ->update([
                'grade' => null,
                'type' => 'Roasted Green Tea',
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

