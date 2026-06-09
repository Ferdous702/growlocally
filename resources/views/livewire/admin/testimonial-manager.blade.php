<div>
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div class="flex gap-3">
            <input wire:model.live.debounce.300ms="search"
                   type="search" placeholder="Search by client name…"
                   class="w-64 rounded-lg border border-gray-300 px-4 py-2 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
            <select wire:model.live="filterStatus"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
            </select>
        </div>
        <button wire:click="openCreate"
                class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">
            + New Testimonial
        </button>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-6 py-3 text-left">Client</th>
                    <th class="px-6 py-3 text-left">Service</th>
                    <th class="px-6 py-3 text-left">Rating</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($testimonials as $t)
                    <tr class="transition hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if ($t->client_avatar)
                                    <img src="{{ asset('storage/' . $t->client_avatar) }}"
                                         class="h-8 w-8 rounded-full object-cover" alt="">
                                @else
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-200 text-xs font-bold text-gray-500">
                                        {{ strtoupper(substr($t->client_name ?? '?', 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-medium text-gray-900">{{ $t->client_name ?? '—' }}</p>
                                    @if ($t->client_company)
                                        <p class="text-xs text-gray-400">{{ $t->client_company }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $t->service?->title ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="text-yellow-500">{{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click="toggleApproval({{ $t->id }})"
                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium transition
                                           {{ $t->status === 'approved' ? 'bg-green-50 text-green-700 hover:bg-green-100' : 'bg-yellow-50 text-yellow-700 hover:bg-yellow-100' }}">
                                {{ ucfirst($t->status) }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="openEdit({{ $t->id }})"
                                    class="mr-3 text-sm font-medium text-blue-600 hover:text-blue-800">Edit</button>
                            <button wire:click="delete({{ $t->id }})"
                                    wire:confirm="Delete this testimonial?"
                                    class="text-sm font-medium text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-400">No testimonials found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($testimonials->hasPages())
            <div class="border-t border-gray-100 px-6 py-4">{{ $testimonials->links() }}</div>
        @endif
    </div>

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
             x-data @click.self="$wire.set('showModal', false)"
             @keydown.escape.window="$wire.set('showModal', false)">
            <div class="w-full max-w-2xl rounded-xl bg-white shadow-2xl">

                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h2 class="text-base font-semibold text-gray-900">
                        {{ $editingId ? 'Edit Testimonial' : 'New Testimonial' }}
                    </h2>
                    <button wire:click="$set('showModal', false)" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form wire:submit="save" class="max-h-[75vh] overflow-y-auto px-6 py-5 space-y-4">

                    <div class="grid grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Client Name</label>
                            <input wire:model="client_name" type="text"
                                   class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Position / Title</label>
                            <input wire:model="client_position" type="text"
                                   class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Company</label>
                            <input wire:model="client_company" type="text"
                                   class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Service (optional)</label>
                            <select wire:model="service_id"
                                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                                <option value="">— None —</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Testimonial Content</label>
                            <textarea wire:model="content" rows="4"
                                      class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rating <span class="text-red-500">*</span></label>
                            <select wire:model="rating"
                                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                                @foreach ([5, 4, 3, 2, 1] as $r)
                                    <option value="{{ $r }}">{{ $r }} {{ str_repeat('★', $r) }}</option>
                                @endforeach
                            </select>
                            @error('rating') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                            <select wire:model="status"
                                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Client Avatar</label>
                            <input wire:model="client_avatar" type="file" accept="image/*"
                                   class="mt-1 w-full text-sm text-gray-600">
                            @error('client_avatar') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            <div wire:loading wire:target="client_avatar" class="mt-1 text-xs text-gray-400">Uploading…</div>
                            @if ($client_avatar)
                                <img src="{{ $client_avatar->temporaryUrl() }}" class="mt-2 h-12 w-12 rounded-full object-cover">
                            @elseif ($currentAvatar)
                                <img src="{{ asset('storage/' . $currentAvatar) }}" class="mt-2 h-12 w-12 rounded-full object-cover">
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-gray-100 pt-4">
                        <button type="button" wire:click="$set('showModal', false)"
                                class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit"
                                class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">
                            <span wire:loading.remove wire:target="save">{{ $editingId ? 'Update' : 'Create' }}</span>
                            <span wire:loading wire:target="save">Saving…</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
