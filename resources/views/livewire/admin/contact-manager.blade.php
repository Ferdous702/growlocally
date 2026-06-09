<div>
    <div class="mb-6">
        <input wire:model.live.debounce.300ms="search"
               type="search" placeholder="Search by name or email…"
               class="w-72 rounded-lg border border-gray-300 px-4 py-2 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Message Preview</th>
                    <th class="px-6 py-3 text-left">Received</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($inquiries as $inquiry)
                    <tr class="cursor-pointer transition hover:bg-gray-50" wire:click="view({{ $inquiry->id }})">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $inquiry->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $inquiry->email }}</td>
                        <td class="px-6 py-4 max-w-xs">
                            <p class="truncate text-gray-500">{{ Str::limit($inquiry->message, 60) }}</p>
                        </td>
                        <td class="px-6 py-4 text-gray-400">{{ $inquiry->created_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 text-right" @click.stop>
                            <button wire:click="view({{ $inquiry->id }})"
                                    class="mr-3 text-sm font-medium text-blue-600 hover:text-blue-800">View</button>
                            <button wire:click="delete({{ $inquiry->id }})"
                                    wire:confirm="Delete this inquiry from {{ $inquiry->name }}?"
                                    class="text-sm font-medium text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-400">No inquiries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($inquiries->hasPages())
            <div class="border-t border-gray-100 px-6 py-4">{{ $inquiries->links() }}</div>
        @endif
    </div>

    {{-- ─── View Modal (read-only) ──────────────────────────────────────── --}}
    @if ($showModal && $viewing)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
             x-data @click.self="$wire.closeModal()"
             @keydown.escape.window="$wire.closeModal()">
            <div class="w-full max-w-lg rounded-xl bg-white shadow-2xl">

                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h2 class="text-base font-semibold text-gray-900">Contact Inquiry</h2>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="px-6 py-5 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Name</p>
                            <p class="mt-1 text-sm font-medium text-gray-900">{{ $viewing->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Email</p>
                            <a href="mailto:{{ $viewing->email }}" class="mt-1 text-sm font-medium text-blue-600 hover:underline">
                                {{ $viewing->email }}
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Message</p>
                        <p class="mt-2 whitespace-pre-wrap rounded-lg bg-gray-50 px-4 py-3 text-sm text-gray-700 leading-relaxed">{{ $viewing->message }}</p>
                    </div>

                    <p class="text-xs text-gray-400">Received {{ $viewing->created_at->format('M j, Y \a\t g:i A') }}</p>
                </div>

                <div class="flex justify-between border-t border-gray-100 px-6 py-4">
                    <button wire:click="delete({{ $viewing->id }})"
                            wire:confirm="Delete this inquiry?"
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
