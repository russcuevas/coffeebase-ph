@extends('layouts.admin')

@section('title', 'Add Matcha Product')
@section('page_title', 'Create New Matcha Product')

@section('content')

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Primary Details & Matcha Technical Specs -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Basic Info -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-5">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 pb-3 border-b border-stone-100 flex items-center gap-2">
                        <i data-lucide="info" class="w-4 h-4 text-gold-500"></i>
                        <span>1. Product Core Information</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="prod_category" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">Category *</label>
                            <select id="prod_category" name="category_id" required class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none bg-white">
                                <option value="">-- Select Matcha Category --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="prod_name" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">Product Name *</label>
                            <input type="text" id="prod_name" name="name" required value="{{ old('name') }}" placeholder="e.g. Samidori Ceremonial Uji Matcha" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div>
                        <label for="prod_desc" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">Description *</label>
                        <textarea id="prod_desc" name="description" rows="3" placeholder="Finely milled matcha from Uji, Kyoto." class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">{{ old('description', 'Finely milled matcha from Uji, Kyoto.') }}</textarea>
                    </div>
                </div>

                <!-- Structured Matcha Specifications (Required User Specs) -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-5">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 pb-3 border-b border-stone-100 flex items-center gap-2">
                        <i data-lucide="sparkles" class="w-4 h-4 text-gold-500"></i>
                        <span>2. Authentic Japanese Matcha Attributes</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="m_grade" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Grade</label>
                            <input type="text" id="m_grade" name="grade" value="{{ old('grade', 'Ceremonial') }}" placeholder="e.g. Ceremonial / Barista Blend" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>

                        <div>
                            <label for="m_origin" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Origin</label>
                            <input type="text" id="m_origin" name="origin" value="{{ old('origin', 'Uji, Kyoto') }}" placeholder="e.g. Uji, Kyoto" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div>
                        <label for="m_flavor" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Flavor Notes</label>
                        <input type="text" id="m_flavor" name="flavor_notes" value="{{ old('flavor_notes', 'Creamy Umami • Sweet Pea • Fresh Greens • Mellow Finish') }}" placeholder="e.g. Creamy Umami • Sweet Pea • Fresh Greens • Mellow Finish" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="m_cultivar" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Cultivar</label>
                            <input type="text" id="m_cultivar" name="cultivar" value="{{ old('cultivar', 'Samidori') }}" placeholder="e.g. Samidori / Okumidori / Yabukita" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>

                        <div>
                            <label for="m_harvest" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Harvest</label>
                            <input type="text" id="m_harvest" name="harvest" value="{{ old('harvest', '1st Flush') }}" placeholder="e.g. 1st Flush / Spring 2024" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="m_milling" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Milling</label>
                            <input type="text" id="m_milling" name="milling" value="{{ old('milling', 'Ball Mill') }}" placeholder="e.g. Ball Mill / Stone Mill" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>

                        <div>
                            <label for="m_picking" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Picking</label>
                            <input type="text" id="m_picking" name="picking" value="{{ old('picking', 'Shears') }}" placeholder="e.g. Shears / Hand Picked" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="m_recommended" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Recommended For</label>
                            <textarea id="m_recommended" name="recommended_for" rows="2" placeholder="Usucha&#10;Matcha Latte" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">{{ old('recommended_for', "Usucha\nMatcha Latte") }}</textarea>
                        </div>

                        <div>
                            <label for="m_storage" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Storage</label>
                            <textarea id="m_storage" name="storage" rows="2" placeholder="Keep refrigerated after opening.&#10;Avoid heat, light and humidity." class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">{{ old('storage', "Keep refrigerated after opening.\nAvoid heat, light and humidity.") }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Weight Variants & Pricing (Dynamic Multiple Weights like 30g, 100g, 1kg) -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-stone-100">
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 flex items-center gap-2">
                                <i data-lucide="scale" class="w-4 h-4 text-gold-500"></i>
                                <span>3. Weight Packages & Pricing</span>
                            </h3>
                            <p class="text-[11px] text-stone-500 mt-0.5">Tag prices for each weight (e.g. 30g, 100g, 1kg) and toggle Sold Out status.</p>
                        </div>

                        <button type="button" onclick="addVariantRow()" class="px-3 py-1.5 bg-matcha-50 text-matcha-800 rounded-lg text-xs font-bold uppercase tracking-wider hover:bg-matcha-100 flex items-center gap-1 border border-matcha-200">
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                            <span>Add Weight Row</span>
                        </button>
                    </div>

                    <div id="variants-container" class="space-y-3">
                        <!-- Variant 1 (30g) -->
                        <div class="variant-row p-4 rounded-xl border border-stone-200 bg-stone-50/50 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                            <div class="sm:col-span-3">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Weight / Variant</label>
                                <input type="text" name="variants[0][weight]" value="30g Tin" required placeholder="e.g. 30g Tin" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-semibold">
                            </div>
                            <div class="sm:col-span-3">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Price (₱) *</label>
                                <input type="number" step="0.01" name="variants[0][price]" value="850.00" required placeholder="850.00" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-mono font-bold text-matcha-950">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Compare Price (₱)</label>
                                <input type="number" step="0.01" name="variants[0][compare_at_price]" value="950.00" placeholder="Optional" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-mono">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Stock Qty</label>
                                <input type="number" name="variants[0][stock_quantity]" value="50" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300">
                            </div>
                            <div class="sm:col-span-2 flex items-center justify-between pt-4 sm:pt-0">
                                <label class="flex items-center space-x-1.5 text-[11px] font-bold text-rose-700 cursor-pointer">
                                    <input type="checkbox" name="variants[0][is_sold_out]" value="1" class="rounded text-rose-600">
                                    <span>Sold Out</span>
                                </label>
                            </div>
                        </div>

                        <!-- Variant 2 (1kg) -->
                        <div class="variant-row p-4 rounded-xl border border-stone-200 bg-stone-50/50 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                            <div class="sm:col-span-3">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Weight / Variant</label>
                                <input type="text" name="variants[1][weight]" value="1kg Bag" required placeholder="e.g. 1kg Bag" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-semibold">
                            </div>
                            <div class="sm:col-span-3">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Price (₱) *</label>
                                <input type="number" step="0.01" name="variants[1][price]" value="18500.00" required placeholder="18500.00" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-mono font-bold text-matcha-950">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Compare Price (₱)</label>
                                <input type="number" step="0.01" name="variants[1][compare_at_price]" value="20000.00" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-mono">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Stock Qty</label>
                                <input type="number" name="variants[1][stock_quantity]" value="15" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300">
                            </div>
                            <div class="sm:col-span-2 flex items-center justify-between pt-4 sm:pt-0">
                                <label class="flex items-center space-x-1.5 text-[11px] font-bold text-rose-700 cursor-pointer">
                                    <input type="checkbox" name="variants[1][is_sold_out]" value="1" class="rounded text-rose-600">
                                    <span>Sold Out</span>
                                </label>
                                <button type="button" onclick="this.closest('.variant-row').remove()" class="text-stone-400 hover:text-rose-600 p-1">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Bulk / Volume Tier Discounts (Automated Tiered Savings) -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-stone-100">
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 flex items-center gap-2">
                                <i data-lucide="percent" class="w-4 h-4 text-gold-500"></i>
                                <span>4. Bulk / Volume Tier Discounts (Manual Input)</span>
                            </h3>
                            <p class="text-[11px] text-stone-500 mt-0.5">Define volume discounts to encourage buyers to purchase in bulk (e.g. 10 units / 10kg get 10% OFF). Displayed directly in the product catalog.</p>
                        </div>

                        <button type="button" onclick="addBulkTierRow()" class="px-3 py-1.5 bg-gold-50 text-gold-800 rounded-lg text-xs font-bold uppercase tracking-wider hover:bg-gold-100 flex items-center gap-1 border border-gold-200">
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                            <span>Add Discount Tier</span>
                        </button>
                    </div>

                    <div id="bulk-tiers-container" class="space-y-3">
                        <!-- Example Tier 1 -->
                        <div class="bulk-tier-row p-4 rounded-xl border border-stone-200 bg-amber-50/20 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                            <div class="sm:col-span-3">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Min Quantity / Units *</label>
                                <input type="number" min="1" name="bulk_discounts[0][min_qty]" value="10" placeholder="e.g. 10" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-semibold">
                            </div>
                            <div class="sm:col-span-3">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Discount % *</label>
                                <div class="relative">
                                    <input type="number" step="0.5" min="0" max="100" name="bulk_discounts[0][discount_percent]" value="10" placeholder="10" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-bold text-matcha-950 pr-7">
                                    <span class="absolute right-2.5 top-2 text-xs font-bold text-stone-400">%</span>
                                </div>
                            </div>
                            <div class="sm:col-span-5">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Callout Label / Note (Optional)</label>
                                <input type="text" name="bulk_discounts[0][label]" value="10+ items get 10% OFF" placeholder="e.g. 10+ items get 10% OFF" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300">
                            </div>
                            <div class="sm:col-span-1 flex items-center justify-end pt-4 sm:pt-4">
                                <button type="button" onclick="this.closest('.bulk-tier-row').remove()" class="text-stone-400 hover:text-rose-600 p-1.5 rounded-lg hover:bg-rose-50 transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right: Image Upload & Visibility Settings -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Product Image Direct Public Upload -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 pb-2 border-b border-stone-100">
                        Product Photo
                    </h3>

                    <div>
                        <label for="prod_primary_image" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Upload Image (Direct to Public)</label>
                        <input type="file" id="prod_primary_image" name="primary_image" accept="image/*" class="w-full text-xs text-stone-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-matcha-50 file:text-matcha-700 hover:file:bg-matcha-100">
                        <p class="text-[10px] text-stone-400 mt-2">Saved directly into public/uploads/products/ without symlink requirements.</p>
                    </div>
                </div>

                <!-- Visibility & Tags -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 pb-2 border-b border-stone-100">
                        Badges & Status
                    </h3>

                    <div>
                        <label for="prod_badge" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Badge / Tag (Optional)</label>
                        <input type="text" id="prod_badge" name="badge" value="{{ old('badge', 'Best Seller') }}" placeholder="e.g. Best Seller / Single Cultivar" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300">
                    </div>

                    <div class="space-y-2 pt-2 border-t border-stone-100">
                        <label class="flex items-center space-x-2 text-xs font-bold text-stone-700 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" checked class="rounded text-matcha-700 focus:ring-matcha-600">
                            <span>Featured on Homepage</span>
                        </label>

                        <label class="flex items-center space-x-2 text-xs font-bold text-stone-700 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked class="rounded text-matcha-700 focus:ring-matcha-600">
                            <span>Active / Live on Catalog</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="space-y-3">
                    <button type="submit" class="w-full py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-xl shadow-md hover:shadow-lg transition-all">
                        Publish Matcha Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="block text-center text-xs text-stone-500 hover:text-stone-800 uppercase tracking-wider">
                        Discard & Back
                    </a>
                </div>

            </div>

        </div>
    </form>

@endsection

@section('scripts')
<script>
    let variantIndex = 2;
    let bulkTierIndex = 1;

    function addVariantRow() {
        const container = document.getElementById('variants-container');
        const row = document.createElement('div');
        row.className = 'variant-row p-4 rounded-xl border border-stone-200 bg-stone-50/50 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center';
        row.innerHTML = `
            <div class="sm:col-span-3">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Weight / Variant</label>
                <input type="text" name="variants[${variantIndex}][weight]" required placeholder="e.g. 100g Pouch" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-semibold">
            </div>
            <div class="sm:col-span-3">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Price (₱) *</label>
                <input type="number" step="0.01" name="variants[${variantIndex}][price]" required placeholder="0.00" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-mono font-bold text-matcha-950">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Compare Price (₱)</label>
                <input type="number" step="0.01" name="variants[${variantIndex}][compare_at_price]" placeholder="Optional" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-mono">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Stock Qty</label>
                <input type="number" name="variants[${variantIndex}][stock_quantity]" value="50" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300">
            </div>
            <div class="sm:col-span-2 flex items-center justify-between pt-4 sm:pt-0">
                <label class="flex items-center space-x-1.5 text-[11px] font-bold text-rose-700 cursor-pointer">
                    <input type="checkbox" name="variants[${variantIndex}][is_sold_out]" value="1" class="rounded text-rose-600">
                    <span>Sold Out</span>
                </label>
                <button type="button" onclick="this.closest('.variant-row').remove()" class="text-stone-400 hover:text-rose-600 p-1">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
        lucide.createIcons();
        variantIndex++;
    }

    function addBulkTierRow() {
        const container = document.getElementById('bulk-tiers-container');
        const row = document.createElement('div');
        row.className = 'bulk-tier-row p-4 rounded-xl border border-stone-200 bg-amber-50/20 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center';
        row.innerHTML = `
            <div class="sm:col-span-3">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Min Quantity / Units *</label>
                <input type="number" min="1" name="bulk_discounts[${bulkTierIndex}][min_qty]" required placeholder="e.g. 20" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-semibold">
            </div>
            <div class="sm:col-span-3">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Discount % *</label>
                <div class="relative">
                    <input type="number" step="0.5" min="0" max="100" name="bulk_discounts[${bulkTierIndex}][discount_percent]" required placeholder="15" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-bold text-matcha-950 pr-7">
                    <span class="absolute right-2.5 top-2 text-xs font-bold text-stone-400">%</span>
                </div>
            </div>
            <div class="sm:col-span-5">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Callout Label / Note (Optional)</label>
                <input type="text" name="bulk_discounts[${bulkTierIndex}][label]" placeholder="e.g. 20+ items get 15% OFF" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300">
            </div>
            <div class="sm:col-span-1 flex items-center justify-end pt-4 sm:pt-4">
                <button type="button" onclick="this.closest('.bulk-tier-row').remove()" class="text-stone-400 hover:text-rose-600 p-1.5 rounded-lg hover:bg-rose-50 transition-colors">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
        lucide.createIcons();
        bulkTierIndex++;
    }
</script>
@endsection
