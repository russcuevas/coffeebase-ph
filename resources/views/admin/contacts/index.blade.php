@extends('layouts.admin')

@section('title', 'Customer Inquiries & Feedback')
@section('page_title', 'Contact Messages & Feedback')

@section('content')

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <p class="text-xs text-stone-500">View customer feedback, wholesale questions, and cafe partnership inquiries.</p>
        </div>

        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-white border border-stone-200 text-xs font-semibold text-stone-700 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Unread Inquiries: <strong class="text-emerald-700 font-bold">{{ $unreadCount }}</strong></span>
            </span>
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-white border border-stone-200 text-xs font-semibold text-stone-700 shadow-sm">
                <span>Total Messages: <strong class="text-matcha-900 font-bold">{{ $messages->count() }}</strong></span>
            </span>
        </div>
    </div>

    <!-- Contacts Table -->
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6">
        <div class="overflow-x-auto">
            <table id="contacts-table" class="w-full text-left text-xs stripe hover">
                <thead class="bg-stone-50 text-stone-500 uppercase tracking-wider border-b border-stone-200">
                    <tr>
                        <th class="p-3 pl-4">Sender</th>
                        <th class="p-3">Contact Details</th>
                        <th class="p-3">Message Snippet</th>
                        <th class="p-3">Received At</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right pr-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @foreach($messages as $msg)
                        <tr class="hover:bg-stone-50/80 transition-colors {{ $msg->status === 'unread' ? 'bg-emerald-50/30' : '' }}">
                            
                            <!-- Sender -->
                            <td class="p-3 pl-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center font-bold text-xs shadow-sm border {{ $msg->status === 'unread' ? 'bg-emerald-100 text-emerald-800 border-emerald-300' : 'bg-matcha-50 text-matcha-800 border-matcha-200' }}">
                                        {{ strtoupper(substr($msg->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-stone-900 text-sm">{{ $msg->name }}</p>
                                        <p class="text-[10px] text-stone-400">ID: #{{ $msg->id }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact Details -->
                            <td class="p-3">
                                <div class="space-y-1">
                                    <a href="mailto:{{ $msg->email }}" class="text-matcha-800 hover:underline font-semibold block flex items-center gap-1">
                                        <i data-lucide="mail" class="w-3.5 h-3.5 text-stone-400 inline"></i>
                                        <span>{{ $msg->email }}</span>
                                    </a>
                                    @if($msg->phone)
                                        <span class="text-stone-500 font-mono text-[11px] block flex items-center gap-1">
                                            <i data-lucide="phone" class="w-3.5 h-3.5 text-stone-400 inline"></i>
                                            <span>{{ $msg->phone }}</span>
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Message Snippet -->
                            <td class="p-3 max-w-xs">
                                <p class="text-stone-700 line-clamp-2 leading-relaxed">
                                    {{ $msg->comment }}
                                </p>
                            </td>

                            <!-- Received At -->
                            <td class="p-3 font-mono text-stone-500 text-[11px] whitespace-nowrap">
                                <div>{{ $msg->created_at->format('M d, Y') }}</div>
                                <div class="text-[10px] text-stone-400">{{ $msg->created_at->format('h:i A') }}</div>
                            </td>

                            <!-- Status -->
                            <td class="p-3 whitespace-nowrap">
                                @if($msg->status === 'unread')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-ping"></span>
                                        Unread
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-stone-100 text-stone-600 border border-stone-200">
                                        Read
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="p-3 text-right pr-4 whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <!-- View Message Modal Trigger -->
                                    <button type="button" 
                                            onclick="openViewModal({{ json_encode([
                                                'id' => $msg->id,
                                                'name' => $msg->name,
                                                'email' => $msg->email,
                                                'phone' => $msg->phone ?? 'N/A',
                                                'comment' => $msg->comment,
                                                'created_at' => $msg->created_at->format('F d, Y \a\t h:i A'),
                                                'status' => $msg->status,
                                                'toggle_url' => route('admin.contacts.read', $msg->id)
                                            ]) }})"
                                            class="px-2.5 py-1.5 bg-matcha-50 hover:bg-matcha-100 text-matcha-800 rounded-lg text-xs font-semibold uppercase tracking-wider inline-flex items-center gap-1 transition-all"
                                            title="View Full Message">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        <span>View</span>
                                    </button>

                                    <!-- Quick Toggle Read/Unread -->
                                    <form action="{{ route('admin.contacts.read', $msg->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="px-2 py-1.5 rounded-lg text-[11px] font-semibold uppercase border transition-all {{ $msg->status === 'unread' ? 'bg-emerald-600 text-white hover:bg-emerald-700 border-emerald-700' : 'bg-stone-100 text-stone-600 hover:bg-stone-200 border-stone-200' }}"
                                                title="Toggle Read / Unread">
                                            {{ $msg->status === 'unread' ? 'Mark Read' : 'Mark Unread' }}
                                        </button>
                                    </form>

                                    <!-- Delete Contact -->
                                    <button type="button" 
                                            onclick="confirmDeleteContact({{ $msg->id }}, '{{ addslashes($msg->name) }}')"
                                            class="p-1.5 text-rose-500 hover:text-rose-700 rounded-lg hover:bg-rose-50 transition-colors"
                                            title="Delete Message">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                    <form id="delete-contact-form-{{ $msg->id }}" action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" class="hidden">
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

    <!-- VIEW CONTACT MODAL -->
    <div id="view-contact-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div class="fixed inset-0 bg-stone-900/60 backdrop-blur-sm" onclick="closeViewModal()"></div>
        <div class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-stone-200 z-10 overflow-hidden transform scale-95 transition-transform duration-300">
            
            <div class="flex items-center justify-between px-6 py-4 border-b border-stone-200 bg-stone-50">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-matcha-100 text-matcha-800 flex items-center justify-center">
                        <i data-lucide="mail-open" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-stone-900">Inquiry Details</h3>
                        <p id="modal-date" class="text-[11px] text-stone-500"></p>
                    </div>
                </div>
                <button type="button" onclick="closeViewModal()" class="text-stone-400 hover:text-stone-700 p-1.5 rounded-lg hover:bg-stone-200">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-3 bg-stone-50 p-4 rounded-xl border border-stone-200">
                    <div>
                        <p class="text-[10px] uppercase font-bold text-stone-400 tracking-wider">Sender Name</p>
                        <p id="modal-sender-name" class="text-xs font-bold text-stone-900 mt-0.5"></p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-stone-400 tracking-wider">Status</p>
                        <span id="modal-status" class="inline-block mt-0.5 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase"></span>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-stone-400 tracking-wider">Email Address</p>
                        <a id="modal-email" href="#" class="text-xs text-matcha-800 hover:underline font-semibold mt-0.5 block truncate"></a>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-stone-400 tracking-wider">Phone Number</p>
                        <p id="modal-phone" class="text-xs font-mono text-stone-800 mt-0.5"></p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-500 mb-1.5">Message / Inquiry</label>
                    <div id="modal-comment" class="p-4 bg-cream-50/50 border border-stone-200 rounded-xl text-xs text-stone-800 leading-relaxed max-h-60 overflow-y-auto whitespace-pre-wrap font-sans">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between px-6 py-4 border-t border-stone-200 bg-stone-50">
                <form id="modal-toggle-form" action="" method="POST">
                    @csrf
                    <button type="submit" id="modal-toggle-btn" class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider border transition-all">
                        Toggle Status
                    </button>
                </form>

                <div class="flex items-center gap-2">
                    <a id="modal-reply-btn" href="#" class="px-4 py-2 bg-matcha-700 hover:bg-matcha-800 text-white rounded-xl text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 shadow-sm">
                        <i data-lucide="send" class="w-3.5 h-3.5"></i>
                        <span>Reply via Email</span>
                    </a>
                    <button type="button" onclick="closeViewModal()" class="px-4 py-2 bg-stone-200 hover:bg-stone-300 text-stone-700 rounded-xl text-xs font-bold uppercase tracking-wider">
                        Close
                    </button>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#contacts-table').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[3, 'desc']], // Sort by Received At desc
            columnDefs: [{ orderable: false, targets: -1 }],
            language: {
                search: "",
                searchPlaceholder: "Search sender, email, inquiry...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ messages",
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

    function openViewModal(msg) {
        document.getElementById('modal-sender-name').textContent = msg.name;
        document.getElementById('modal-email').textContent = msg.email;
        document.getElementById('modal-email').href = 'mailto:' + msg.email;
        document.getElementById('modal-reply-btn').href = 'mailto:' + msg.email + '?subject=' + encodeURIComponent('Re: Inquiry to Coffee Base / Matcha') + '&body=' + encodeURIComponent('\n\n--- Original Message ---\n' + msg.comment);
        document.getElementById('modal-phone').textContent = msg.phone;
        document.getElementById('modal-date').textContent = 'Received ' + msg.created_at;
        document.getElementById('modal-comment').textContent = msg.comment;
        
        const statusBadge = document.getElementById('modal-status');
        const toggleBtn = document.getElementById('modal-toggle-btn');
        const toggleForm = document.getElementById('modal-toggle-form');
        toggleForm.action = msg.toggle_url;

        if (msg.status === 'unread') {
            statusBadge.className = 'inline-block mt-0.5 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800 border border-emerald-300';
            statusBadge.textContent = 'Unread';
            toggleBtn.className = 'px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold uppercase tracking-wider border border-emerald-700';
            toggleBtn.textContent = 'Mark as Read';
        } else {
            statusBadge.className = 'inline-block mt-0.5 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-stone-100 text-stone-600 border border-stone-200';
            statusBadge.textContent = 'Read';
            toggleBtn.className = 'px-4 py-2 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-xl text-xs font-bold uppercase tracking-wider border border-stone-300';
            toggleBtn.textContent = 'Mark as Unread';
        }

        const modal = document.getElementById('view-contact-modal');
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');
        modal.querySelector('.transform').classList.remove('scale-95');
        modal.querySelector('.transform').classList.add('scale-100');

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    function closeViewModal() {
        const modal = document.getElementById('view-contact-modal');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100', 'pointer-events-auto');
        modal.querySelector('.transform').classList.add('scale-95');
        modal.querySelector('.transform').classList.remove('scale-100');
    }

    function confirmDeleteContact(id, name) {
        Swal.fire({
            title: 'Delete Message?',
            html: `Are you sure you want to permanently delete the inquiry from <strong>${name}</strong>?`,
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
                document.getElementById('delete-contact-form-' + id).submit();
            }
        });
    }
</script>
@endpush
