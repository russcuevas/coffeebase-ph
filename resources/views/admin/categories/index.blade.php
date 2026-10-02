@extends('layouts.admin')

@section('title', 'Matcha Categories')
@section('page_title', 'Matcha Category Management')

@section('content')

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <p class="text-xs text-stone-500">Organize your matcha catalog into Ceremonial, Reserve, Barista, and Ware
                collections.</p>
        </div>
        <button type="button" onclick="openAddCategoryModal()"
            class="px-4 py-2.5 bg-matcha-700 hover:bg-matcha-800 text-white rounded-xl text-xs font-semibold uppercase tracking-wider flex items-center gap-1.5 shadow-xs transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Add Category</span>
        </button>
    </div>

    <!-- Categories DataTable Card -->
    <div class="bg-white rounded-3xl border border-stone-200/90 shadow-sm p-6 sm:p-8">
        <div class="overflow-x-auto">
            <table id="categories-table" class="w-full text-left text-xs stripe hover">
                <thead>
                    <tr
                        class="bg-stone-50 text-stone-600 uppercase font-bold tracking-wider text-[11px] border-b border-stone-200">
                        <th class="py-4 px-4 pl-6 rounded-l-xl">Category</th>
                        <th class="py-4 px-4">Slug</th>
                        <th class="py-4 px-4">Products Count</th>
                        <th class="py-4 px-4">Status</th>
                        <th class="py-4 px-4 pr-6 text-right rounded-r-xl">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @foreach ($categories as $category)
                        <tr class="hover:bg-cream-50/60 transition-colors">
                            <td class="py-4 px-4 pl-6 font-bold text-stone-900 text-sm">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-stone-100 border border-stone-200 overflow-hidden flex items-center justify-center flex-shrink-0">
                                        @if ($category->image)
                                            <img src="{{ $category->image }}" alt="{{ $category->name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <i data-lucide="folder" class="w-4 h-4 text-stone-400"></i>
                                        @endif
                                    </div>
                                    <span>{{ $category->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4 font-mono text-stone-500 text-xs">
                                {{ $category->slug }}
                            </td>
                            <td class="py-4 px-4 font-semibold text-matcha-800">
                                <span class="bg-matcha-50 text-matcha-800 px-2 py-1 rounded-md border border-matcha-200">
                                    {{ $category->products_count }} products
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                @if ($category->is_active)
                                    <span
                                        class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-300">Active</span>
                                @else
                                    <span
                                        class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-stone-100 text-stone-600 border border-stone-300">Hidden</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 pr-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button"
                                        onclick="openEditCategoryModal({{ json_encode([
                                            'id' => $category->id,
                                            'name' => $category->name,
                                            'description' => $category->description,
                                            'is_active' => (bool) $category->is_active,
                                            'update_url' => route('admin.categories.update', $category->id),
                                        ]) }})"
                                        class="px-3 py-1.5 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-lg text-xs font-semibold uppercase tracking-wider transition-colors inline-flex items-center gap-1">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        <span>Edit</span>
                                    </button>

                                    <button type="button"
                                        onclick="confirmDeleteCategory('{{ route('admin.categories.destroy', $category->id) }}', '{{ addslashes($category->name) }}', {{ $category->products_count }})"
                                        class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg text-xs font-semibold uppercase tracking-wider transition-colors inline-flex items-center gap-1">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ADD CATEGORY MODAL -->
    <div id="add-category-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-stone-950/60 backdrop-blur-xs transition-opacity cursor-pointer"
            onclick="closeAddCategoryModal()"></div>
        <div class="relative bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl z-10 transform scale-95 transition-transform duration-300 overflow-hidden"
            id="add-category-card">
            <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                <h3 class="text-lg font-sans font-bold text-stone-950">Add New Category</h3>
                <button type="button" onclick="closeAddCategoryModal()"
                    class="text-stone-400 hover:text-stone-700 p-1.5 rounded-full hover:bg-stone-100 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4 pt-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Category Name
                        *</label>
                    <input type="text" name="name" required placeholder="e.g. Single Cultivar Reserve"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Description
                        (Optional)</label>
                    <textarea name="description" rows="3" placeholder="Brief overview of this matcha collection..."
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Category Image
                        (Optional)</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full text-xs text-stone-500 file:mr-2 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-matcha-50 file:text-matcha-800 hover:file:bg-matcha-100 border border-stone-200 rounded-xl p-1.5">
                </div>

                <div class="pt-1">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked
                            class="rounded text-matcha-700 focus:ring-matcha-600 w-4 h-4">
                        <span class="text-xs font-medium text-stone-800">Active (Visible in catalog)</span>
                    </label>
                </div>

                <div class="pt-4 border-t border-stone-100 flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeAddCategoryModal()"
                        class="px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-stone-600 hover:bg-stone-100 rounded-xl transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-matcha-800 hover:bg-matcha-900 text-white rounded-xl text-xs font-bold uppercase tracking-wider shadow transition-colors">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT CATEGORY MODAL -->
    <div id="edit-category-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-stone-950/60 backdrop-blur-xs transition-opacity cursor-pointer"
            onclick="closeEditCategoryModal()"></div>
        <div class="relative bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl z-10 transform scale-95 transition-transform duration-300 overflow-hidden"
            id="edit-category-card">
            <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                <h3 class="text-lg font-sans font-bold text-stone-950">Edit Category</h3>
                <button type="button" onclick="closeEditCategoryModal()"
                    class="text-stone-400 hover:text-stone-700 p-1.5 rounded-full hover:bg-stone-100 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="edit-category-form" method="POST" enctype="multipart/form-data" class="space-y-4 pt-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Category Name
                        *</label>
                    <input type="text" id="edit-category-name" name="name" required
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Description
                        (Optional)</label>
                    <textarea id="edit-category-description" name="description" rows="3"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Change Image
                        (Optional)</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full text-xs text-stone-500 file:mr-2 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-matcha-50 file:text-matcha-800 hover:file:bg-matcha-100 border border-stone-200 rounded-xl p-1.5">
                </div>

                <div class="pt-1">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" id="edit-category-is-active" name="is_active" value="1"
                            class="rounded text-matcha-700 focus:ring-matcha-600 w-4 h-4">
                        <span class="text-xs font-medium text-stone-800">Active (Visible in catalog)</span>
                    </label>
                </div>

                <div class="pt-4 border-t border-stone-100 flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeEditCategoryModal()"
                        class="px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-stone-600 hover:bg-stone-100 rounded-xl transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-matcha-800 hover:bg-matcha-900 text-white rounded-xl text-xs font-bold uppercase tracking-wider shadow transition-colors">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden Delete Form for SweetAlert -->
    <form id="delete-category-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#categories-table').DataTable({
                responsive: true,
                pageLength: 10,
                columnDefs: [{ orderable: false, targets: -1 }],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search categories...",
                    lengthMenu: "Show _MENU_ categories",
                    info: "Showing _START_ to _END_ of _TOTAL_ categories",
                    paginate: {
                        previous: "Prev",
                        next: "Next"
                    }
                },
                drawCallback: function() {
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                }
            });
        });

        // Add Modal Functions
        function openAddCategoryModal() {
            const modal = document.getElementById('add-category-modal');
            const card = document.getElementById('add-category-card');
            modal.classList.remove('pointer-events-none', 'opacity-0');
            modal.classList.add('pointer-events-auto', 'opacity-100');
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
        }

        function closeAddCategoryModal() {
            const modal = document.getElementById('add-category-modal');
            const card = document.getElementById('add-category-card');
            card.classList.remove('scale-100');
            card.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.remove('pointer-events-auto', 'opacity-100');
                modal.classList.add('pointer-events-none', 'opacity-0');
            }, 200);
        }

        // Edit Modal Functions
        function openEditCategoryModal(cat) {
            document.getElementById('edit-category-form').action = cat.update_url;
            document.getElementById('edit-category-name').value = cat.name;
            document.getElementById('edit-category-description').value = cat.description || '';
            document.getElementById('edit-category-is-active').checked = cat.is_active;

            const modal = document.getElementById('edit-category-modal');
            const card = document.getElementById('edit-category-card');
            modal.classList.remove('pointer-events-none', 'opacity-0');
            modal.classList.add('pointer-events-auto', 'opacity-100');
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
        }

        function closeEditCategoryModal() {
            const modal = document.getElementById('edit-category-modal');
            const card = document.getElementById('edit-category-card');
            card.classList.remove('scale-100');
            card.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.remove('pointer-events-auto', 'opacity-100');
                modal.classList.add('pointer-events-none', 'opacity-0');
            }, 200);
        }

        // SweetAlert2 Delete Confirmation
        function confirmDeleteCategory(deleteUrl, categoryName, productCount) {
            let warningText = `Are you sure you want to delete "${categoryName}"?`;
            if (productCount > 0) {
                warningText += ` Warning: There are ${productCount} products associated with this category.`;
            }

            Swal.fire({
                title: 'Delete Category?',
                text: warningText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#78716c',
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
                customClass: {
                    popup: 'rounded-2xl shadow-xl',
                    confirmButton: 'rounded-xl px-5 py-2.5 text-xs font-bold uppercase tracking-wider',
                    cancelButton: 'rounded-xl px-5 py-2.5 text-xs font-semibold uppercase tracking-wider'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-category-form');
                    form.action = deleteUrl;
                    form.submit();
                }
            });
        }
    </script>
@endsection
