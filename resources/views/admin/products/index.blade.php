@extends('layouts.admin')

@section('title', 'Matcha Products')
@section('page_title', 'Matcha Products & Variant Pricing')

@section('content')

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <p class="text-xs text-stone-500">Manage matcha grades, origins, technical specifications, and weights/prices (30g, 100g, 1kg).</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="px-4 py-2.5 bg-matcha-700 hover:bg-matcha-800 text-white rounded-xl text-xs font-semibold uppercase tracking-wider flex items-center gap-1.5 shadow-sm transition-all hover:shadow-md">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Add New Matcha Product</span>
        </a>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6">
        <div class="overflow-x-auto">
            <table id="products-table" class="w-full text-left text-xs stripe hover">
                <thead class="bg-stone-50 text-stone-500 uppercase tracking-wider border-b border-stone-200">
                    <tr>
                        <th class="p-3 pl-4">Product</th>
                        <th class="p-3">Category</th>
                        <th class="p-3">Grade & Origin</th>
                        <th class="p-3">Variant Weights & Pricing</th>
                        <th class="p-3">Availability</th>
                        <th class="p-3 text-right pr-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @foreach($products as $product)
                        <tr class="hover:bg-stone-50/80 transition-colors">
                            
                            <!-- Image & Name -->
                            <td class="p-3 pl-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 rounded-xl bg-cream-100 overflow-hidden flex-shrink-0 border border-stone-200 shadow-xs">
                                        <img src="{{ $product->primary_image ?: '/uploads/products/samidori.jpg' }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="font-bold text-stone-900 text-sm hover:text-matcha-800 transition-colors block">
                                            {{ $product->name }}
                                        </a>
                                        @if($product->badge)
                                            <span class="inline-block mt-0.5 px-2 py-0.5 rounded-full bg-matcha-100 text-matcha-800 text-[9px] font-bold uppercase tracking-wider border border-matcha-200">
                                                {{ $product->badge }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="p-3 text-stone-600 font-semibold whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-lg bg-stone-100 text-stone-700 border border-stone-200 text-[11px]">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>

                            <!-- Grade & Origin -->
                            <td class="p-3">
                                <span class="font-bold text-matcha-950 block">{{ $product->grade ?? 'Ceremonial Grade' }}</span>
                                <span class="text-stone-500 text-[11px] block">{{ $product->origin ?? 'Kyoto, Japan' }} • {{ $product->cultivar ?? 'Samidori' }}</span>
                            </td>

                            <!-- Variant Weights & Prices -->
                            <td class="p-3">
                                <div class="space-y-1.5 min-w-[180px]">
                                    @foreach($product->variants as $variant)
                                        <div class="flex items-center justify-between gap-2 bg-stone-50 px-2.5 py-1 rounded-lg border border-stone-200">
                                            <span class="font-mono font-semibold text-stone-700 text-[11px]">{{ $variant->weight }}:</span>
                                            <span class="font-serif font-bold text-matcha-950 text-xs">₱{{ number_format($variant->price, 2) }}</span>
                                            
                                            <!-- Quick Toggle Sold Out -->
                                            <form action="{{ route('admin.variants.toggle_sold_out', $variant->id) }}" method="POST" class="inline">
                                                @csrf
                                                @if($variant->is_sold_out)
                                                    <button type="submit" class="px-1.5 py-0.5 rounded bg-rose-100 text-rose-800 text-[9px] font-bold uppercase hover:bg-rose-200 border border-rose-300" title="Click to mark as available">
                                                        Sold Out
                                                    </button>
                                                @else
                                                    <button type="submit" class="px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-800 text-[9px] font-bold uppercase hover:bg-emerald-200 border border-emerald-300" title="Click to mark as sold out">
                                                        Available
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <!-- Overall Status -->
                            <td class="p-3 whitespace-nowrap">
                                @if($product->is_sold_out)
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-rose-100 text-rose-800 border border-rose-300">
                                        All Sold Out
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800 border border-emerald-300">
                                        In Stock
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="p-3 text-right pr-4 whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('shop.show', $product->slug) }}" target="_blank" class="px-2.5 py-1.5 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all" title="View in Storefront">
                                        Preview
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="px-2.5 py-1.5 bg-matcha-50 hover:bg-matcha-100 text-matcha-800 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all">
                                        Edit
                                    </a>
                                    <button type="button" 
                                            onclick="confirmDeleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                            class="px-2.5 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all">
                                        Delete
                                    </button>
                                    <form id="delete-product-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#products-table').DataTable({
            responsive: true,
            pageLength: 10,
            columnDefs: [{ orderable: false, targets: -1 }],
            language: {
                search: "",
                searchPlaceholder: "Search products, categories, grades, origins...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ products",
                paginate: {
                    previous: "Prev",
                    next: "Next"
                }
            }
        });

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });

    function confirmDeleteProduct(id, name) {
        Swal.fire({
            title: 'Delete Product?',
            html: `Are you sure you want to delete <strong>${name}</strong> and all its weight variants? This cannot be undone.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1e3d29',
            cancelButtonColor: '#a8a29e',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            customClass: {
                popup: 'rounded-2xl font-sans',
                confirmButton: 'rounded-xl px-5 py-2.5 font-bold uppercase tracking-wider text-xs',
                cancelButton: 'rounded-xl px-5 py-2.5 font-bold uppercase tracking-wider text-xs'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-product-form-' + id).submit();
            }
        });
    }
</script>
@endpush
