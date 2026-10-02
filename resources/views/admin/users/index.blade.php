@extends('layouts.admin')

@section('title', 'User Management')
@section('page_title', 'Admins & Customer Accounts')

@section('content')

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <!-- Quick Stats Pills -->
        <div class="flex items-center gap-2">
            <span class="px-3.5 py-1.5 rounded-xl bg-white border border-stone-200 text-stone-800 text-xs font-semibold shadow-xs">
                Total: <strong>{{ $users->count() }}</strong>
            </span>
            <span class="px-3.5 py-1.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs font-semibold shadow-xs">
                Admins: <strong>{{ $adminCount }}</strong>
            </span>
            <span class="px-3.5 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs font-semibold shadow-xs">
                Customers: <strong>{{ $customerCount }}</strong>
            </span>
        </div>

        <button type="button" onclick="openAddUserModal()" class="px-4 py-2.5 bg-matcha-700 hover:bg-matcha-800 text-white rounded-xl text-xs font-semibold uppercase tracking-wider flex items-center gap-1.5 shadow-xs transition-all">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            <span>Add New User</span>
        </button>
    </div>

    <!-- Users DataTable Card -->
    <div class="bg-white rounded-3xl border border-stone-200/90 shadow-sm p-6 sm:p-8">
        <div class="overflow-x-auto">
            <table id="users-table" class="w-full text-left text-xs stripe hover">
                <thead>
                    <tr class="bg-stone-50 text-stone-600 uppercase font-bold tracking-wider text-[11px] border-b border-stone-200">
                        <th class="py-4 px-4 pl-6 rounded-l-xl">User / Client</th>
                        <th class="py-4 px-4">Role</th>
                        <th class="py-4 px-4">Contact & Phone</th>
                        <th class="py-4 px-4">Registered Location</th>
                        <th class="py-4 px-4">Orders Placed</th>
                        <th class="py-4 px-4">Joined Date</th>
                        <th class="py-4 px-4 pr-6 text-right rounded-r-xl">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @foreach($users as $user)
                        <tr class="hover:bg-cream-50/60 transition-colors">
                            <td class="py-4 px-4 pl-6">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full {{ $user->role === 'admin' ? 'bg-amber-100 text-amber-900 border border-amber-300' : 'bg-matcha-50 text-matcha-800 border border-matcha-200' }} flex items-center justify-center font-bold text-xs flex-shrink-0">
                                        {{ strtoupper(substr($user->first_name ?: $user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-stone-900 text-xs">{{ $user->name }}</p>
                                        <p class="text-stone-400 text-[11px] font-mono">{{ $user->email }}</p>
                                        @if($user->company)
                                            <span class="text-[10px] text-stone-500 italic block">{{ $user->company }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-4">
                                @if($user->role === 'admin')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-100 text-amber-900 border border-amber-300">
                                        Super Admin
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-stone-100 text-stone-700 border border-stone-300">
                                        Customer
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-4 font-mono text-stone-700">
                                {{ $user->phone ?? '—' }}
                            </td>

                            <td class="py-4 px-4 text-stone-600">
                                @if($user->city)
                                    <span class="font-medium text-stone-900">{{ $user->city }}</span>
                                    <span class="block text-[10px] text-stone-400">{{ $user->region ?? 'Philippines' }}</span>
                                @else
                                    <span class="text-stone-400 italic">No address saved</span>
                                @endif
                            </td>

                            <td class="py-4 px-4 font-bold text-matcha-900">
                                <span class="bg-stone-50 px-2 py-1 rounded-md border border-stone-200">
                                    {{ $user->orders_count }} order(s)
                                </span>
                            </td>

                            <td class="py-4 px-4 text-stone-500 font-mono text-[11px]" data-sort="{{ $user->created_at->timestamp }}">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>

                            <td class="py-4 px-4 pr-6 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Edit Button -->
                                    <button type="button" 
                                        onclick="openEditUserModal({{ json_encode([
                                            'id' => $user->id,
                                            'name' => $user->name,
                                            'first_name' => $user->first_name ?: explode(' ', $user->name)[0],
                                            'last_name' => $user->last_name ?: (explode(' ', $user->name)[1] ?? ''),
                                            'email' => $user->email,
                                            'phone' => $user->phone,
                                            'company' => $user->company,
                                            'city' => $user->city,
                                            'role' => $user->role,
                                            'update_url' => route('admin.users.update', $user->id)
                                        ]) }})"
                                        class="px-2.5 py-1.5 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-lg text-xs font-semibold uppercase tracking-wider transition-colors inline-flex items-center gap-1">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        <span>Edit</span>
                                    </button>

                                    <!-- Delete Button -->
                                    @if($user->id !== auth()->id())
                                        <button type="button" 
                                            onclick="confirmDeleteUser('{{ route('admin.users.destroy', $user->id) }}', '{{ addslashes($user->name) }}')"
                                            class="p-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg text-xs font-semibold uppercase tracking-wider transition-colors"
                                            title="Delete User">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ADD USER MODAL -->
    <div id="add-user-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-stone-950/60 backdrop-blur-xs transition-opacity cursor-pointer" onclick="closeAddUserModal()"></div>
        <div class="relative bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl z-10 transform scale-95 transition-transform duration-300 overflow-hidden" id="add-user-card">
            <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                <h3 class="text-lg font-sans font-bold text-stone-950">Add New User</h3>
                <button type="button" onclick="closeAddUserModal()" class="text-stone-400 hover:text-stone-700 p-1.5 rounded-full hover:bg-stone-100 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4 pt-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">First Name *</label>
                        <input type="text" name="first_name" required placeholder="Juan" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Last Name *</label>
                        <input type="text" name="last_name" required placeholder="Dela Cruz" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Email Address *</label>
                        <input type="email" name="email" required placeholder="juan@example.com" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Phone Number</label>
                        <input type="text" name="phone" placeholder="0917 123 4567" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Role *</label>
                        <select name="role" required class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none bg-white">
                            <option value="customer">Customer</option>
                            <option value="admin">Super Admin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Password *</label>
                        <input type="password" name="password" required placeholder="Min 6 characters" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Company / Cafe</label>
                        <input type="text" name="company" placeholder="e.g. Kyoto Cafe" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">City</label>
                        <input type="text" name="city" placeholder="e.g. Makati City" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <div class="pt-4 border-t border-stone-100 flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeAddUserModal()" class="px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-stone-600 hover:bg-stone-100 rounded-xl transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-matcha-800 hover:bg-matcha-900 text-white rounded-xl text-xs font-bold uppercase tracking-wider shadow transition-colors">
                        Create Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT USER MODAL -->
    <div id="edit-user-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-stone-950/60 backdrop-blur-xs transition-opacity cursor-pointer" onclick="closeEditUserModal()"></div>
        <div class="relative bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl z-10 transform scale-95 transition-transform duration-300 overflow-hidden" id="edit-user-card">
            <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                <h3 class="text-lg font-sans font-bold text-stone-950">Edit User Details</h3>
                <button type="button" onclick="closeEditUserModal()" class="text-stone-400 hover:text-stone-700 p-1.5 rounded-full hover:bg-stone-100 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="edit-user-form" method="POST" class="space-y-4 pt-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">First Name *</label>
                        <input type="text" id="edit-user-first-name" name="first_name" required class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Last Name *</label>
                        <input type="text" id="edit-user-last-name" name="last_name" required class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Email Address *</label>
                        <input type="email" id="edit-user-email" name="email" required class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Phone Number</label>
                        <input type="text" id="edit-user-phone" name="phone" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Role *</label>
                        <select id="edit-user-role" name="role" required class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none bg-white">
                            <option value="customer">Customer</option>
                            <option value="admin">Super Admin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">New Password (Optional)</label>
                        <input type="password" name="password" placeholder="Leave blank to keep current" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">Company / Cafe</label>
                        <input type="text" id="edit-user-company" name="company" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">City</label>
                        <input type="text" id="edit-user-city" name="city" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:ring-2 focus:ring-matcha-600 outline-none">
                    </div>
                </div>

                <div class="pt-4 border-t border-stone-100 flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeEditUserModal()" class="px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-stone-600 hover:bg-stone-100 rounded-xl transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-matcha-800 hover:bg-matcha-900 text-white rounded-xl text-xs font-bold uppercase tracking-wider shadow transition-colors">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden Delete Form for SweetAlert -->
    <form id="delete-user-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            responsive: true,
            pageLength: 10,
            columnDefs: [{ orderable: false, targets: -1 }],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search users, email, phone...",
                lengthMenu: "Show _MENU_ users",
                info: "Showing _START_ to _END_ of _TOTAL_ users",
                paginate: { previous: "Prev", next: "Next" }
            },
            drawCallback: function() {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }
        });
    });

    // Add User Modal
    function openAddUserModal() {
        const modal = document.getElementById('add-user-modal');
        const card = document.getElementById('add-user-card');
        modal.classList.remove('pointer-events-none', 'opacity-0');
        modal.classList.add('pointer-events-auto', 'opacity-100');
        card.classList.remove('scale-95');
        card.classList.add('scale-100');
    }

    function closeAddUserModal() {
        const modal = document.getElementById('add-user-modal');
        const card = document.getElementById('add-user-card');
        card.classList.remove('scale-100');
        card.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('pointer-events-auto', 'opacity-100');
            modal.classList.add('pointer-events-none', 'opacity-0');
        }, 200);
    }

    // Edit User Modal
    function openEditUserModal(user) {
        document.getElementById('edit-user-form').action = user.update_url;
        document.getElementById('edit-user-first-name').value = user.first_name || '';
        document.getElementById('edit-user-last-name').value = user.last_name || '';
        document.getElementById('edit-user-email').value = user.email || '';
        document.getElementById('edit-user-phone').value = user.phone || '';
        document.getElementById('edit-user-company').value = user.company || '';
        document.getElementById('edit-user-city').value = user.city || '';
        document.getElementById('edit-user-role').value = user.role || 'customer';

        const modal = document.getElementById('edit-user-modal');
        const card = document.getElementById('edit-user-card');
        modal.classList.remove('pointer-events-none', 'opacity-0');
        modal.classList.add('pointer-events-auto', 'opacity-100');
        card.classList.remove('scale-95');
        card.classList.add('scale-100');
    }

    function closeEditUserModal() {
        const modal = document.getElementById('edit-user-modal');
        const card = document.getElementById('edit-user-card');
        card.classList.remove('scale-100');
        card.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('pointer-events-auto', 'opacity-100');
            modal.classList.add('pointer-events-none', 'opacity-0');
        }, 200);
    }

    // SweetAlert Delete User
    function confirmDeleteUser(deleteUrl, userName) {
        Swal.fire({
            title: 'Delete User Account?',
            text: `Are you sure you want to permanently delete account for "${userName}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#78716c',
            confirmButtonText: 'Yes, delete user',
            cancelButtonText: 'Cancel',
            customClass: {
                popup: 'rounded-2xl shadow-xl',
                confirmButton: 'rounded-xl px-5 py-2.5 text-xs font-bold uppercase tracking-wider',
                cancelButton: 'rounded-xl px-5 py-2.5 text-xs font-semibold uppercase tracking-wider'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('delete-user-form');
                form.action = deleteUrl;
                form.submit();
            }
        });
    }
</script>
@endsection
