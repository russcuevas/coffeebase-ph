<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        
        $query = Product::with(['category', 'variants'])->where('is_active', true);

        // Filter by Category
        if ($request->filled('category')) {
            $catSlug = $request->category;
            $cleanSlug = str_replace(['singles-', 'single-'], '', $catSlug);
            $query->whereHas('category', function ($q) use ($catSlug, $cleanSlug) {
                $q->where('slug', $catSlug)
                  ->orWhere('slug', 'LIKE', '%' . $cleanSlug . '%')
                  ->orWhere('name', 'LIKE', '%' . str_replace('-', ' ', $catSlug) . '%');
            });
        }

        // Filter by Grade
        if ($request->filled('grade')) {
            $query->where('grade', 'LIKE', '%' . $request->grade . '%');
        }

        // Search query
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('origin', 'LIKE', "%{$search}%")
                  ->orWhere('cultivar', 'LIKE', "%{$search}%")
                  ->orWhere('flavor_notes', 'LIKE', "%{$search}%");
            });
        }

        // Sort
        if ($request->get('sort') === 'price_low') {
            $query->join('product_variants', 'products.id', '=', 'product_variants.product_id')
                  ->select('products.*')
                  ->groupBy('products.id')
                  ->orderByRaw('MIN(product_variants.price) ASC');
        } elseif ($request->get('sort') === 'price_high') {
            $query->join('product_variants', 'products.id', '=', 'product_variants.product_id')
                  ->select('products.*')
                  ->groupBy('products.id')
                  ->orderByRaw('MAX(product_variants.price) DESC');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();

        return view('frontend.shop.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'variants' => function($q) {
            $q->orderBy('price', 'asc');
        }])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with(['category', 'variants'])
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('frontend.shop.show', compact('product', 'relatedProducts'));
    }
}
