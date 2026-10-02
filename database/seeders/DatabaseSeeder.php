<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ContactMessage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admins and Customers
        $admin = User::create([
            'role' => 'admin',
            'name' => 'Coffee Base Admin',
            'first_name' => 'Coffee Base',
            'last_name' => 'Admin',
            'email' => 'admin@coffeebase.ph',
            'phone' => '09171234567',
            'password' => Hash::make('admin12345'),
            'company' => 'Coffee Base Philippines',
            'address' => 'BGC Taguig',
            'barangay' => 'Fort Bonifacio',
            'city' => 'Taguig',
            'postal_code' => '1634',
            'region' => 'Metro Manila',
            'country' => 'Philippines',
        ]);

        $customer = User::create([
            'role' => 'customer',
            'name' => 'Juan Dela Cruz',
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'email' => 'customer@example.com',
            'phone' => '09189876543',
            'password' => Hash::make('customer12345'),
            'company' => 'Cafe Manila',
            'address' => 'Unit 1204, Green Residences, Taft Ave',
            'apartment' => 'Unit 1204',
            'barangay' => 'Barangay 709',
            'city' => 'Manila',
            'postal_code' => '1004',
            'region' => 'Metro Manila',
            'country' => 'Philippines',
        ]);

        // 2. Categories
        $catCeremonial = Category::create([
            'name' => 'Ceremonial Grade Matcha',
            'slug' => 'ceremonial-grade-matcha',
            'description' => 'Highest quality first harvest single cultivar and master blended matcha for pure usucha and koicha preparation.',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $catReserve = Category::create([
            'name' => 'Single Cultivar Reserve',
            'slug' => 'single-cultivar-reserve',
            'description' => 'Exquisite rare varietals showcasing distinct terroir and artisanal stone-milled perfection.',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $catBarista = Category::create([
            'name' => 'Barista & Culinary Blend',
            'slug' => 'barista-and-culinary-blend',
            'description' => 'Rich, vibrant, and robust matcha profiles specially formulated for craft matcha lattes and fine baking.',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        $catWare = Category::create([
            'name' => 'Tea Ware & Accessories',
            'slug' => 'tea-ware-and-accessories',
            'description' => 'Traditional Japanese bamboo whisks (chasen), ceramic bowls (chawan), and scoops (chashaku).',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // 3. Products (Each with only 30g and 1kg wholesale)
        // Product 1: Samidori Ceremonial
        $p1 = Product::create([
            'category_id' => $catCeremonial->id,
            'name' => 'Samidori Ceremonial Uji Matcha',
            'slug' => 'samidori-ceremonial-uji-matcha',
            'description' => 'Finely milled matcha from Uji, Kyoto. Renowned for its radiant emerald brilliance, deep umami sweetness, and zero astringency.',
            'grade' => 'Ceremonial',
            'flavor_notes' => 'Creamy Umami • Sweet Pea • Fresh Greens • Mellow Finish',
            'origin' => 'Uji, Kyoto',
            'cultivar' => 'Samidori',
            'harvest' => '1st Flush',
            'milling' => 'Ball Mill',
            'picking' => 'Shears',
            'recommended_for' => "Usucha\nMatcha Latte",
            'storage' => "Keep refrigerated after opening.\nAvoid heat, light and humidity.",
            'primary_image' => '/uploads/products/samidori.jpg',
            'badge' => 'Best Seller',
            'is_featured' => true,
            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $p1->id,
            'weight' => '30g',
            'price' => 850.00,
            'compare_at_price' => 950.00,
            'sku' => 'MAT-SAM-30G',
            'stock_quantity' => 100,
            'is_sold_out' => false,
            'is_default' => true,
        ]);

        ProductVariant::create([
            'product_id' => $p1->id,
            'weight' => '1kg (Wholesale)',
            'price' => 18500.00,
            'compare_at_price' => 20000.00,
            'sku' => 'MAT-SAM-1KG',
            'stock_quantity' => 15,
            'is_sold_out' => false,
            'is_default' => false,
        ]);

        // Product 2: Okumidori Single Origin
        $p2 = Product::create([
            'category_id' => $catReserve->id,
            'name' => 'Okumidori Single Origin Reserve',
            'slug' => 'okumidori-single-origin-reserve',
            'description' => 'Artisanal stone-ground single varietal harvest from Fukuoka. Features an extraordinarily smooth texture and rich cocoa-floral finish.',
            'grade' => 'Ceremonial Reserve',
            'flavor_notes' => 'Toasted Chestnut • Deep Umami • Velvety Cocoa • Floral Aroma',
            'origin' => 'Yame, Fukuoka',
            'cultivar' => 'Okumidori',
            'harvest' => 'Spring 2024 (1st Flush)',
            'milling' => 'Stone Mill',
            'picking' => 'Hand Picked',
            'recommended_for' => "Koicha\nUsucha",
            'storage' => "Keep refrigerated after opening.\nAvoid heat, light and humidity.",
            'primary_image' => '/uploads/products/samidori.jpg',
            'badge' => 'Single Cultivar',
            'is_featured' => true,
            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $p2->id,
            'weight' => '30g',
            'price' => 1150.00,
            'compare_at_price' => 1300.00,
            'sku' => 'MAT-OKU-30G',
            'stock_quantity' => 60,
            'is_sold_out' => false,
            'is_default' => true,
        ]);

        ProductVariant::create([
            'product_id' => $p2->id,
            'weight' => '1kg (Wholesale)',
            'price' => 24000.00,
            'compare_at_price' => 26000.00,
            'sku' => 'MAT-OKU-1KG',
            'stock_quantity' => 8,
            'is_sold_out' => false,
            'is_default' => false,
        ]);

        // Product 3: Barista Blend Daily Matcha
        $p3 = Product::create([
            'category_id' => $catBarista->id,
            'name' => 'Barista Blend Daily Matcha',
            'slug' => 'barista-blend-daily-matcha',
            'description' => 'Formulated specifically for specialty cafe baristas. Bold vegetal punch with a sweet lingering finish that pairs harmoniously with whole milk, oat milk, or soy.',
            'grade' => 'Barista / Daily Blend',
            'flavor_notes' => 'Bold Vegetal • Subtle Astringency • Rich Body • Sweet Aftertaste',
            'origin' => 'Nishio, Aichi',
            'cultivar' => 'Yabukita & Sayamakaori',
            'harvest' => '2nd Flush',
            'milling' => 'Ball Mill',
            'picking' => 'Shears',
            'recommended_for' => "Matcha Latte\nIced Matcha\nPastries & Baking",
            'storage' => "Keep tightly sealed in a cool, dry place away from sunlight.",
            'primary_image' => '/uploads/products/barista-blend.jpg',
            'badge' => 'Cafe Favorite',
            'is_featured' => true,
            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $p3->id,
            'weight' => '30g',
            'price' => 450.00,
            'compare_at_price' => 550.00,
            'sku' => 'MAT-BAR-30G',
            'stock_quantity' => 150,
            'is_sold_out' => false,
            'is_default' => true,
        ]);

        ProductVariant::create([
            'product_id' => $p3->id,
            'weight' => '1kg (Wholesale)',
            'price' => 5800.00,
            'compare_at_price' => 6500.00,
            'sku' => 'MAT-BAR-1KG',
            'stock_quantity' => 45,
            'is_sold_out' => false,
            'is_default' => false,
        ]);

        // Product 4: Asahi Grand Cru (Sold Out sample)
        $p4 = Product::create([
            'category_id' => $catCeremonial->id,
            'name' => 'Asahi Grand Cru Limited Harvest (Sold Out)',
            'slug' => 'asahi-grand-cru-limited-harvest',
            'description' => 'Ultra-rare micro-lot matcha harvested from shaded 40-year old single tea trees in Wazuka. Intensely sweet with zero bitterness.',
            'grade' => 'Grand Cru Ceremonial',
            'flavor_notes' => 'Condensed Milk • Roasted Pistachio • Pure Umami • Lingering Sweetness',
            'origin' => 'Wazuka, Kyoto',
            'cultivar' => 'Asahi',
            'harvest' => '1st Flush',
            'milling' => 'Granite Stone Mill',
            'picking' => 'Hand Picked',
            'recommended_for' => "Koicha\nUsucha",
            'storage' => "Keep refrigerated at 4°C.",
            'primary_image' => '/uploads/products/samidori.jpg',
            'badge' => 'Sold Out',
            'is_featured' => false,
            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $p4->id,
            'weight' => '30g',
            'price' => 1650.00,
            'compare_at_price' => 1800.00,
            'sku' => 'MAT-ASA-30G',
            'stock_quantity' => 0,
            'is_sold_out' => true,
            'is_default' => true,
        ]);

        ProductVariant::create([
            'product_id' => $p4->id,
            'weight' => '1kg (Wholesale)',
            'price' => 28000.00,
            'compare_at_price' => 30000.00,
            'sku' => 'MAT-ASA-1KG',
            'stock_quantity' => 0,
            'is_sold_out' => true,
            'is_default' => false,
        ]);

        // 4. Sample Orders (Without Shipping Fee)
        // Order 1: Pending
        $o1 = Order::create([
            'order_number' => 'CB-' . date('Ymd') . '-1001',
            'user_id' => $customer->id,
            'customer_first_name' => 'Juan',
            'customer_last_name' => 'Dela Cruz',
            'customer_email' => 'customer@example.com',
            'customer_phone' => '09189876543',
            'company' => 'Cafe Manila',
            'country' => 'Philippines',
            'address' => 'Unit 1204, Green Residences, Taft Ave',
            'apartment' => 'Unit 1204',
            'barangay' => 'Barangay 709',
            'city' => 'Manila',
            'postal_code' => '1004',
            'region' => 'Metro Manila',
            'subtotal' => 850.00,
            'shipping_fee' => 0.00,
            'total_amount' => 850.00,
            'payment_method' => 'Cash on Delivery',
            'payment_status' => 'pending',
            'status' => 'pending',
            'customer_notes' => 'Please call upon arrival at the lobby.',
        ]);

        OrderItem::create([
            'order_id' => $o1->id,
            'product_id' => $p1->id,
            'product_name' => $p1->name,
            'variant_weight' => '30g',
            'unit_price' => 850.00,
            'quantity' => 1,
            'subtotal' => 850.00,
        ]);

        // Order 2: Preparing
        $o2 = Order::create([
            'order_number' => 'CB-' . date('Ymd') . '-1002',
            'user_id' => $customer->id,
            'customer_first_name' => 'Maria',
            'customer_last_name' => 'Santos',
            'customer_email' => 'maria.santos@gmail.com',
            'customer_phone' => '09175551234',
            'country' => 'Philippines',
            'address' => '15 Acacia Ave, Ayala Alabang Village',
            'barangay' => 'Ayala Alabang',
            'city' => 'Muntinlupa',
            'postal_code' => '1780',
            'region' => 'Metro Manila',
            'subtotal' => 1150.00,
            'shipping_fee' => 0.00,
            'total_amount' => 1150.00,
            'payment_method' => 'GCash',
            'payment_status' => 'paid',
            'status' => 'preparing',
            'preparing_at' => now()->subMinutes(25),
        ]);

        OrderItem::create([
            'order_id' => $o2->id,
            'product_id' => $p2->id,
            'product_name' => $p2->name,
            'variant_weight' => '30g',
            'unit_price' => 1150.00,
            'quantity' => 1,
            'subtotal' => 1150.00,
        ]);

        // Order 3: Out for Delivery with Live Lalamove Tracking Link
        $o3 = Order::create([
            'order_number' => 'CB-' . date('Ymd') . '-1003',
            'user_id' => $customer->id,
            'customer_first_name' => 'Juan',
            'customer_last_name' => 'Dela Cruz',
            'customer_email' => 'customer@example.com',
            'customer_phone' => '09189876543',
            'company' => 'Cafe Manila',
            'country' => 'Philippines',
            'address' => 'Unit 1204, Green Residences, Taft Ave',
            'barangay' => 'Barangay 709',
            'city' => 'Manila',
            'postal_code' => '1004',
            'region' => 'Metro Manila',
            'subtotal' => 5800.00,
            'shipping_fee' => 0.00,
            'total_amount' => 5800.00,
            'payment_method' => 'Bank Transfer (BDO)',
            'payment_status' => 'paid',
            'status' => 'out_for_delivery',
            'tracking_courier' => 'Lalamove Express',
            'tracking_link' => 'https://m.lalamove.com/order-track?tracking_id=LLM-PH-9928174',
            'preparing_at' => now()->subHours(2),
            'out_for_delivery_at' => now()->subMinutes(15),
        ]);

        OrderItem::create([
            'order_id' => $o3->id,
            'product_id' => $p3->id,
            'product_name' => $p3->name,
            'variant_weight' => '1kg (Wholesale)',
            'unit_price' => 5800.00,
            'quantity' => 1,
            'subtotal' => 5800.00,
        ]);

        // 5. Contact Inquiries
        ContactMessage::create([
            'name' => 'Chloe Garcia',
            'email' => 'chloe@artisancafe.ph',
            'phone' => '09191234567',
            'comment' => 'Hi Coffee Base! We are opening a new specialty matcha bar in Makati. Do you offer bulk samples for the 1kg wholesale packs?',
            'status' => 'unread',
        ]);
    }
}
