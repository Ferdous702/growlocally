<div>
    {{-- ─── Stats bar ───────────────────────────────────────────────────────── --}}
    <div class="mb-6 grid grid-cols-3 gap-4">
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-100 text-center">
            <p class="text-2xl font-bold text-amber-500">{{ $counts['pending'] }}</p>
            <p class="mt-1 text-xs font-semibold uppercase tracking-wider text-gray-400">Pending</p>
        </div>
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-100 text-center">
            <p class="text-2xl font-bold text-green-600">{{ $counts['confirmed'] }}</p>
            <p class="mt-1 text-xs font-semibold uppercase tracking-wider text-gray-400">Confirmed</p>
        </div>
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-100 text-center">
            <p class="text-2xl font-bold text-red-500">{{ $counts['cancelled'] }}</p>
            <p class="mt-1 text-xs font-semibold uppercase tracking-wider text-gray-400">Cancelled</p>
        </div>
    </div>

    {{-- ─── Filters ─────────────────────────────────────────────────────────── --}}
    <div class="mb-6 flex gap-3">
        <input wire:model.live.debounce.300ms="search"
               type="search" placeholder="Search by name, email or business…"
               class="w-80 rounded-lg border border-gray-300 px-4 py-2 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">

        <select wire:model.live="status"
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
            <option value="">All statuses</option>
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    {{-- ─── Table ───────────────────────────────────────────────────────────── --}}
    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-6 py-3 text-left">Name / Business</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Service</th>
                    <th class="px-6 py-3 text-left">Preferred Date</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($bookings as $booking)
                    <tr class="cursor-pointer transition hover:bg-gray-50" wire:click="view({{ $booking->id }})">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-900">{{ $booking->name }}</p>
                            @if ($booking->business_name)
                                <p class="text-xs text-gray-400">{{ $booking->business_name }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $booking->email }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $booking->service }}</td>
                        <td class="px-6 py-4 text-gray-400">
                            @if ($booking->preferred_date)
                                {{ $booking->preferred_date->format('j M Y') }}
                                @if ($booking->preferred_time)
                                    <span class="ml-1 text-xs">({{ $booking->preferred_time }})</span>
                                @endif
                            @else
                                <span class="text-gray-300">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $badge = match($booking->status) {
                                    'confirmed' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-600',
                                    default     => 'bg-amber-100 text-amber-700',
                                };
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $badge }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right" @click.stop>
                            <button wire:click="view({{ $booking->id }})"
                                    class="mr-2 text-sm font-medium text-blue-600 hover:text-blue-800">View</button>
                            <button wire:click="delete({{ $booking->id }})"
                                    wire:confirm="Delete booking from {{ $booking->name }}?"
                                    class="text-sm font-medium text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-400">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($bookings->hasPages())
            <div class="border-t border-gray-100 px-6 py-4">{{ $bookings->links() }}</div>
        @endif
    </div>

    {{-- ─── View / Edit Modal ───────────────────────────────────────────────── --}}
    @if ($showModal && $viewing)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
             x-data @click.self="$wire.closeModal()"
             @keydown.escape.window="$wire.closeModal()">
            <div class="w-full max-w-lg rounded-xl bg-white shadow-2xl">

                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h2 class="text-base font-semibold text-gray-900">Booking Details</h2>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Name</p>
                            <p class="mt-1 text-sm font-medium text-gray-900">{{ $viewing->name }}</p>
                        </div>
                        @if ($viewing->business_name)
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Business</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $viewing->business_name }}</p>
                        </div>
                        @endif
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Email</p>
                            <a href="mailto:{{ $viewing->email }}" class="mt-1 text-sm font-medium text-blue-600 hover:underline">
                                {{ $viewing->email }}
                            </a>
                        </div>
                        @if ($viewing->phone)
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Phone</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $viewing->phone }}</p>
                        </div>
                        @endif
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Service</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $viewing->service }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Preferred Date</p>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $viewing->preferred_date?->format('j F Y') ?? '—' }}
                                @if ($viewing->preferred_time)
                                    <span class="text-gray-500">({{ $viewing->preferred_time }})</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    @if ($viewing->description)
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Message</p>
                        <p class="mt-2 whitespace-pre-wrap rounded-lg bg-gray-50 px-4 py-3 text-sm text-gray-700 leading-relaxed">{{ $viewing->description }}</p>
                    </div>
                    @endif

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Update Status</p>
                        <div class="flex gap-2">
                            <button wire:click="updateStatus({{ $viewing->id }}, 'pending')"
                                    class="rounded-lg border px-3 py-1.5 text-xs font-semibold transition
                                           {{ $viewing->status === 'pending' ? 'border-amber-400 bg-amber-100 text-amber-700' : 'border-gray-200 text-gray-500 hover:bg-gray-50' }}">
                                Pending
                            </button>
                            <button wire:click="updateStatus({{ $viewing->id }}, 'confirmed')"
                                    class="rounded-lg border px-3 py-1.5 text-xs font-semibold transition
                                           {{ $viewing->status === 'confirmed' ? 'border-green-400 bg-green-100 text-green-700' : 'border-gray-200 text-gray-500 hover:bg-gray-50' }}">
                                Confirmed
                            </button>
                            <button wire:click="updateStatus({{ $viewing->id }}, 'cancelled')"
                                    class="rounded-lg border px-3 py-1.5 text-xs font-semibold transition
                                           {{ $viewing->status === 'cancelled' ? 'border-red-400 bg-red-100 text-red-600' : 'border-gray-200 text-gray-500 hover:bg-gray-50' }}">
                                Cancelled
                            </button>
                        </div>
                    </div>

                    <p class="text-xs text-gray-400">Submitted {{ $viewing->created_at->format('M j, Y \a\t g:i A') }}</p>
                </div>

                <div class="flex justify-between border-t border-gray-100 px-6 py-4">
                    <button wire:click="delete({{ $viewing->id }})"
                            wire:confirm="Delete this booking?"
                            class="rounded-lg border border-red-200 px-4 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50">
                        Delete
                    </button>
                    <a href="mailto:{{ $viewing->email }}"
                       class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">
                        Reply via Email
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
