@extends('layouts.admin')

@section('title', "Edit {$category->name}")
@section('page_title', "Edit Category: {$category->name}")

@section('content')

    <div class="max-w-2xl bg-white rounded-2xl border border-stone-200 p-8 shadow-sm">
        
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="cat_name" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">Category Name *</label>
                <input type="text" id="cat_name" name="name" required value="{{ old('name', $category->name) }}" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
            </div>

            <div>
                <label for="cat_desc" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">Description (Optional)</label>
                <textarea id="cat_desc" name="description" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">{{ old('description', $category->description) }}</textarea>
            </div>

            <div>
                <label for="cat_image" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">Update Cover Image</label>
                @if($category->image)
                    <div class="mb-2 w-20 h-20 rounded-lg overflow-hidden border border-stone-300">
                        <img src="{{ $category->image }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <input type="file" id="cat_image" name="image" accept="image/*" class="w-full text-xs text-stone-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-matcha-50 file:text-matcha-700 hover:file:bg-matcha-100">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="cat_sort" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1.5">Sort Order</label>
                    <input type="number" id="cat_sort" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" class="w-full px-4 py-2 rounded-lg border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                </div>

                <div class="flex items-center pt-6">
                    <label class="flex items-center space-x-2 text-xs font-bold text-stone-700 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }} class="rounded text-matcha-700 focus:ring-matcha-600">
                        <span>Active / Visible on Store</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-stone-100">
                <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 bg-stone-100 text-stone-600 text-xs font-semibold uppercase rounded-lg hover:bg-stone-200">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 bg-matcha-700 hover:bg-matcha-800 text-white text-xs font-semibold uppercase tracking-wider rounded-lg shadow-sm">
                    Update Category
                </button>
            </div>
        </form>

    </div>

@endsection
