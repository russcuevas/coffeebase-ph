<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['category', 'variants'])->latest()->get();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'grade' => 'nullable|string|max:100',
            'flavor_notes' => 'nullable|string|max:500',
            'origin' => 'nullable|string|max:100',
            'cultivar' => 'nullable|string|max:100',
            'harvest' => 'nullable|string|max:100',
            'milling' => 'nullable|string|max:100',
            'picking' => 'nullable|string|max:100',
            'recommended_for' => 'nullable|string|max:500',
            'storage' => 'nullable|string|max:500',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'badge' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            // Variants
            'variants' => 'required|array|min:1',
            'variants.*.weight' => 'required|string|max:100',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.compare_at_price' => 'nullable|numeric|min:0',
            'variants.*.stock_quantity' => 'nullable|integer|min:0',
            'variants.*.is_sold_out' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('primary_image')) {
            $file = $request->file('primary_image');
            $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/products');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $imagePath = '/uploads/products/' . $fileName;
        }

        $product = Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(4),
            'description' => $validated['description'] ?? null,
            'grade' => $validated['grade'] ?? null,
            'flavor_notes' => $validated['flavor_notes'] ?? null,
            'origin' => $validated['origin'] ?? null,
            'cultivar' => $validated['cultivar'] ?? null,
            'harvest' => $validated['harvest'] ?? null,
            'milling' => $validated['milling'] ?? null,
            'picking' => $validated['picking'] ?? null,
            'recommended_for' => $validated['recommended_for'] ?? null,
            'storage' => $validated['storage'] ?? null,
            'primary_image' => $imagePath,
            'badge' => $validated['badge'] ?? null,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        // Create variants
        foreach ($request->variants as $index => $vData) {
            if (!empty($vData['weight']) && isset($vData['price'])) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'weight' => $vData['weight'],
                    'price' => $vData['price'],
                    'compare_at_price' => $vData['compare_at_price'] ?? null,
                    'stock_quantity' => $vData['stock_quantity'] ?? 50,
                    'is_sold_out' => isset($vData['is_sold_out']) && $vData['is_sold_out'] == '1',
                    'is_default' => $index === 0,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Matcha product created successfully!');
    }

    public function edit(Product $product)
    {
        $product->load(['variants', 'category']);
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'grade' => 'nullable|string|max:100',
            'flavor_notes' => 'nullable|string|max:500',
            'origin' => 'nullable|string|max:100',
            'cultivar' => 'nullable|string|max:100',
            'harvest' => 'nullable|string|max:100',
            'milling' => 'nullable|string|max:100',
            'picking' => 'nullable|string|max:100',
            'recommended_for' => 'nullable|string|max:500',
            'storage' => 'nullable|string|max:500',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'badge' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            // Variants
            'variants' => 'required|array|min:1',
            'variants.*.id' => 'nullable|integer',
            'variants.*.weight' => 'required|string|max:100',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.compare_at_price' => 'nullable|numeric|min:0',
            'variants.*.stock_quantity' => 'nullable|integer|min:0',
            'variants.*.is_sold_out' => 'nullable|boolean',
        ]);

        $imagePath = $product->primary_image;
        if ($request->hasFile('primary_image')) {
            $file = $request->file('primary_image');
            $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/products');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $imagePath = '/uploads/products/' . $fileName;
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'grade' => $validated['grade'] ?? null,
            'flavor_notes' => $validated['flavor_notes'] ?? null,
            'origin' => $validated['origin'] ?? null,
            'cultivar' => $validated['cultivar'] ?? null,
            'harvest' => $validated['harvest'] ?? null,
            'milling' => $validated['milling'] ?? null,
            'picking' => $validated['picking'] ?? null,
            'recommended_for' => $validated['recommended_for'] ?? null,
            'storage' => $validated['storage'] ?? null,
            'primary_image' => $imagePath,
            'badge' => $validated['badge'] ?? null,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        // Synchronize variants
        $submittedVariantIds = [];
        foreach ($request->variants as $index => $vData) {
            if (!empty($vData['weight']) && isset($vData['price'])) {
                $isSoldOut = isset($vData['is_sold_out']) && ($vData['is_sold_out'] == '1' || $vData['is_sold_out'] === true);
                
                if (!empty($vData['id'])) {
                    $variant = ProductVariant::find($vData['id']);
                    if ($variant && $variant->product_id == $product->id) {
                        $variant->update([
                            'weight' => $vData['weight'],
                            'price' => $vData['price'],
                            'compare_at_price' => $vData['compare_at_price'] ?? null,
                            'stock_quantity' => $vData['stock_quantity'] ?? 50,
                            'is_sold_out' => $isSoldOut,
                        ]);
                        $submittedVariantIds[] = $variant->id;
                    }
                } else {
                    $newVariant = ProductVariant::create([
                        'product_id' => $product->id,
                        'weight' => $vData['weight'],
                        'price' => $vData['price'],
                        'compare_at_price' => $vData['compare_at_price'] ?? null,
                        'stock_quantity' => $vData['stock_quantity'] ?? 50,
                        'is_sold_out' => $isSoldOut,
                        'is_default' => $index === 0,
                    ]);
                    $submittedVariantIds[] = $newVariant->id;
                }
            }
        }

        // Delete removed variants
        if (!empty($submittedVariantIds)) {
            ProductVariant::where('product_id', $product->id)->whereNotIn('id', $submittedVariantIds)->delete();
        }

        return redirect()->route('admin.products.index')->with('success', 'Product and variant pricing updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function toggleSoldOut(Request $request, ProductVariant $variant)
    {
        $variant->is_sold_out = !$variant->is_sold_out;
        $variant->save();

        return back()->with('success', "Variant {$variant->weight} status set to " . ($variant->is_sold_out ? 'Sold Out' : 'Available'));
    }
}
