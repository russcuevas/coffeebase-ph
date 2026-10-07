@extends('layouts.admin')

@section('title', "Edit {$product->name}")
@section('page_title', "Edit Product: {$product->name}")

@section('content')

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Primary Details & Technical Specs -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Core Info -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-5">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 pb-3 border-b border-stone-100 flex items-center gap-2">
                        <i data-lucide="info" class="w-4 h-4 text-gold-500"></i>
                        <span>1. Product Core Information</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="edit_prod_category" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">Category *</label>
                            <select id="edit_prod_category" name="category_id" required class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none bg-white">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="edit_prod_name" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">Product Name *</label>
                            <input type="text" id="edit_prod_name" name="name" required value="{{ old('name', $product->name) }}" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div>
                        <label for="edit_prod_desc" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">Description *</label>
                        <textarea id="edit_prod_desc" name="description" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <!-- Structured Matcha Specifications -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-5">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 pb-3 border-b border-stone-100 flex items-center gap-2">
                        <i data-lucide="sparkles" class="w-4 h-4 text-gold-500"></i>
                        <span>2. Authentic Japanese Matcha Attributes</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="edit_m_grade" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Grade</label>
                            <input type="text" id="edit_m_grade" name="grade" value="{{ old('grade', $product->grade) }}" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>

                        <div>
                            <label for="edit_m_origin" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Origin</label>
                            <input type="text" id="edit_m_origin" name="origin" value="{{ old('origin', $product->origin) }}" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div>
                        <label for="edit_m_flavor" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Flavor Notes</label>
                        <input type="text" id="edit_m_flavor" name="flavor_notes" value="{{ old('flavor_notes', $product->flavor_notes) }}" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="edit_m_cultivar" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Cultivar</label>
                            <input type="text" id="edit_m_cultivar" name="cultivar" value="{{ old('cultivar', $product->cultivar) }}" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>

                        <div>
                            <label for="edit_m_harvest" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Harvest</label>
                            <input type="text" id="edit_m_harvest" name="harvest" value="{{ old('harvest', $product->harvest) }}" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="edit_m_milling" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Milling</label>
                            <input type="text" id="edit_m_milling" name="milling" value="{{ old('milling', $product->milling) }}" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>

                        <div>
                            <label for="edit_m_picking" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Picking</label>
                            <input type="text" id="edit_m_picking" name="picking" value="{{ old('picking', $product->picking) }}" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="edit_m_recommended" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Recommended For</label>
                            <textarea id="edit_m_recommended" name="recommended_for" rows="2" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">{{ old('recommended_for', $product->recommended_for) }}</textarea>
                        </div>

                        <div>
                            <label for="edit_m_storage" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1">Storage</label>
                            <textarea id="edit_m_storage" name="storage" rows="2" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-xs focus:ring-2 focus:ring-matcha-600 outline-none">{{ old('storage', $product->storage) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Weight Variants & Pricing -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-stone-100">
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 flex items-center gap-2">
                                <i data-lucide="scale" class="w-4 h-4 text-gold-500"></i>
                                <span>3. Weight Packages & Pricing</span>
                            </h3>
                            <p class="text-[11px] text-stone-500 mt-0.5">Modify prices for weights and toggle Sold Out tags.</p>
                        </div>

                        <button type="button" onclick="addVariantRow()" class="px-3 py-1.5 bg-matcha-50 text-matcha-800 rounded-lg text-xs font-bold uppercase tracking-wider hover:bg-matcha-100 flex items-center gap-1 border border-matcha-200">
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                            <span>Add Weight Row</span>
                        </button>
                    </div>

                    <div id="variants-container" class="space-y-3">
                        @foreach($product->variants as $index => $variant)
                            <div class="variant-row p-4 rounded-xl border border-stone-200 bg-stone-50/50 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                                <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
                                
                                <div class="sm:col-span-3">
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Weight / Variant</label>
                                    <input type="text" name="variants[{{ $index }}][weight]" value="{{ $variant->weight }}" required class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-semibold">
                                </div>
                                <div class="sm:col-span-3">
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Price (₱) *</label>
                                    <input type="number" step="0.01" name="variants[{{ $index }}][price]" value="{{ $variant->price }}" required class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-mono font-bold text-matcha-950">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Compare Price (₱)</label>
                                    <input type="number" step="0.01" name="variants[{{ $index }}][compare_at_price]" value="{{ $variant->compare_at_price }}" placeholder="Optional" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-mono">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Stock Qty</label>
                                    <input type="number" name="variants[{{ $index }}][stock_quantity]" value="{{ $variant->stock_quantity }}" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300">
                                </div>
                                <div class="sm:col-span-2 flex items-center justify-between pt-4 sm:pt-0">
                                    <label class="flex items-center space-x-1.5 text-[11px] font-bold text-rose-700 cursor-pointer">
                                        <input type="checkbox" name="variants[{{ $index }}][is_sold_out]" value="1" {{ $variant->is_sold_out ? 'checked' : '' }} class="rounded text-rose-600">
                                        <span>Sold Out</span>
                                    </label>
                                    @if($loop->count > 1)
                                        <button type="button" onclick="this.closest('.variant-row').remove()" class="text-stone-400 hover:text-rose-600 p-1">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 4. Bulk / Volume Tier Discounts (Manual Input) -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-stone-100">
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 flex items-center gap-2">
                                <i data-lucide="percent" class="w-4 h-4 text-gold-500"></i>
                                <span>4. Bulk / Volume Tier Discounts (Manual Input)</span>
                            </h3>
                            <p class="text-[11px] text-stone-500 mt-0.5">Configure volume discount tiers (e.g. 10 units / 10kg get 10% OFF). Displayed directly in the product catalog.</p>
                        </div>

                        <button type="button" onclick="addBulkTierRow()" class="px-3 py-1.5 bg-gold-50 text-gold-800 rounded-lg text-xs font-bold uppercase tracking-wider hover:bg-gold-100 flex items-center gap-1 border border-gold-200">
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                            <span>Add Discount Tier</span>
                        </button>
                    </div>

                    <div id="bulk-tiers-container" class="space-y-3">
                        @php
                            $bulkDiscounts = $product->bulk_discounts ?? [];
                        @endphp

                        @forelse($bulkDiscounts as $bIndex => $tier)
                            <div class="bulk-tier-row p-4 rounded-xl border border-stone-200 bg-amber-50/20 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                                <div class="sm:col-span-3">
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Min Quantity / Units *</label>
                                    <input type="number" min="1" name="bulk_discounts[{{ $bIndex }}][min_qty]" value="{{ $tier['min_qty'] ?? '' }}" required placeholder="e.g. 10" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-semibold">
                                </div>
                                <div class="sm:col-span-3">
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Discount % *</label>
                                    <div class="relative">
                                        <input type="number" step="0.5" min="0" max="100" name="bulk_discounts[{{ $bIndex }}][discount_percent]" value="{{ $tier['discount_percent'] ?? '' }}" required placeholder="10" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-bold text-matcha-950 pr-7">
                                        <span class="absolute right-2.5 top-2 text-xs font-bold text-stone-400">%</span>
                                    </div>
                                </div>
                                <div class="sm:col-span-5">
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Callout Label / Note (Optional)</label>
                                    <input type="text" name="bulk_discounts[{{ $bIndex }}][label]" value="{{ $tier['label'] ?? '' }}" placeholder="e.g. 10+ items get 10% OFF" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300">
                                </div>
                                <div class="sm:col-span-1 flex items-center justify-end pt-4 sm:pt-4">
                                    <button type="button" onclick="this.closest('.bulk-tier-row').remove()" class="text-stone-400 hover:text-rose-600 p-1.5 rounded-lg hover:bg-rose-50 transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div id="no-bulk-tiers-msg" class="p-4 rounded-xl border border-dashed border-stone-200 text-center text-xs text-stone-400">
                                No bulk discount tiers configured for this product yet. Click "+ Add Discount Tier" above to add one.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- Right: Image & Badges -->
            <div class="lg:col-span-4 space-y-6">
                
                <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 pb-2 border-b border-stone-100">
                        Product Photo
                    </h3>

                    @if($product->primary_image)
                        <div class="w-32 h-32 rounded-xl overflow-hidden border border-stone-300 bg-cream-100 mb-2">
                            <img src="{{ $product->primary_image }}" class="w-full h-full object-cover">
                        </div>
                    @endif

                    <div>
                        <label for="edit_prod_primary_image" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Replace Image (Direct to Public)</label>
                        <input type="file" id="edit_prod_primary_image" name="primary_image" accept="image/*" class="w-full text-xs text-stone-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-matcha-50 file:text-matcha-700 hover:file:bg-matcha-100">
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-matcha-950 pb-2 border-b border-stone-100">
                        Badges & Status
                    </h3>

                    <div>
                        <label for="edit_prod_badge" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Badge / Tag (Optional)</label>
                        <input type="text" id="edit_prod_badge" name="badge" value="{{ old('badge', $product->badge) }}" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300">
                    </div>

                    <div class="space-y-2 pt-2 border-t border-stone-100">
                        <label class="flex items-center space-x-2 text-xs font-bold text-stone-700 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} class="rounded text-matcha-700 focus:ring-matcha-600">
                            <span>Featured on Homepage</span>
                        </label>

                        <label class="flex items-center space-x-2 text-xs font-bold text-stone-700 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="rounded text-matcha-700 focus:ring-matcha-600">
                            <span>Active / Live on Catalog</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="space-y-3">
                    <button type="submit" class="w-full py-3.5 bg-matcha-800 hover:bg-matcha-900 text-cream-50 text-xs font-bold uppercase tracking-[0.2em] rounded-xl shadow-md hover:shadow-lg transition-all">
                        Update Matcha Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="block text-center text-xs text-stone-500 hover:text-stone-800 uppercase tracking-wider">
                        Cancel & Back
                    </a>
                </div>

            </div>

        </div>
    </form>

@endsection

@section('scripts')
<script>
    let variantIndex = {{ count($product->variants) }};
    let bulkTierIndex = {{ is_array($product->bulk_discounts) ? count($product->bulk_discounts) : 0 }};

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
        const noMsg = document.getElementById('no-bulk-tiers-msg');
        if (noMsg) noMsg.remove();

        const container = document.getElementById('bulk-tiers-container');
        const row = document.createElement('div');
        row.className = 'bulk-tier-row p-4 rounded-xl border border-stone-200 bg-amber-50/20 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center';
        row.innerHTML = `
            <div class="sm:col-span-3">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Min Quantity / Units *</label>
                <input type="number" min="1" name="bulk_discounts[${bulkTierIndex}][min_qty]" required placeholder="e.g. 10" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-semibold">
            </div>
            <div class="sm:col-span-3">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Discount % *</label>
                <div class="relative">
                    <input type="number" step="0.5" min="0" max="100" name="bulk_discounts[${bulkTierIndex}][discount_percent]" required placeholder="10" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300 font-bold text-matcha-950 pr-7">
                    <span class="absolute right-2.5 top-2 text-xs font-bold text-stone-400">%</span>
                </div>
            </div>
            <div class="sm:col-span-5">
                <label class="block text-[10px] font-bold uppercase tracking-wider text-stone-600 mb-1">Callout Label / Note (Optional)</label>
                <input type="text" name="bulk_discounts[${bulkTierIndex}][label]" placeholder="e.g. 10+ items get 10% OFF" class="w-full px-3 py-2 text-xs rounded-lg border border-stone-300">
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
