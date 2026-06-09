<div>
    {{-- ─── Toolbar ─────────────────────────────────────────────────────── --}}
    <div class="mb-6 flex items-center justify-between gap-4">
        <input wire:model.live.debounce.300ms="search"
               type="search" placeholder="Search services…"
               class="w-72 rounded-lg border border-gray-300 px-4 py-2 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
        <button wire:click="openCreate"
                class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">
            + New Service
        </button>
    </div>

    {{-- ─── Table ───────────────────────────────────────────────────────── --}}
    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-6 py-3 text-left">Title</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Featured</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($services as $service)
                    <tr class="transition hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if ($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}"
                                         class="h-9 w-9 rounded-lg object-cover" alt="">
                                @else
                                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 text-gray-400 text-xs">
                                        No img
                                    </div>
                                @endif
                                <div>
                                    <p class="font-medium text-gray-900">{{ $service->title }}</p>
                                    <p class="text-xs text-gray-400">{{ $service->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                         {{ $service->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if ($service->is_featured)
                                <span class="inline-flex items-center rounded-full bg-yellow-50 px-2.5 py-0.5 text-xs font-medium text-yellow-700">Featured</span>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="openEdit({{ $service->id }})"
                                    class="mr-3 text-sm font-medium text-blue-600 hover:text-blue-800">Edit</button>
                            <button wire:click="delete({{ $service->id }})"
                                    wire:confirm="Delete '{{ $service->title }}'? This cannot be undone."
                                    class="text-sm font-medium text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-sm text-gray-400">No services found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($services->hasPages())
            <div class="border-t border-gray-100 px-6 py-4">
                {{ $services->links() }}
            </div>
        @endif
    </div>

    {{-- ─── Create / Edit Modal ────────────────────────────────────────── --}}
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
             x-data @click.self="$wire.set('showModal', false)"
             @keydown.escape.window="$wire.set('showModal', false)">
            <div class="w-full max-w-2xl rounded-xl bg-white shadow-2xl">

                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h2 class="text-base font-semibold text-gray-900">
                        {{ $editingId ? 'Edit Service' : 'New Service' }}
                    </h2>
                    <button wire:click="$set('showModal', false)" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form wire:submit="save" class="max-h-[75vh] overflow-y-auto px-6 py-5 space-y-4">

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                            <input wire:model.blur="title" type="text"
                                   class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                            @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Slug <span class="text-red-500">*</span></label>
                            <input wire:model="slug" type="text"
                                   class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-mono outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                            @error('slug') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Short Description</label>
                            <input wire:model="short_description" type="text" maxlength="255"
                                   class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                            @error('short_description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea wire:model="description" rows="5"
                                      class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20"></textarea>
                            @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Icon (class or name)</label>
                            <input wire:model="icon" type="text" placeholder="e.g. heroicon-code"
                                   class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image</label>
                            <input wire:model="image" type="file" accept="image/*"
                                   class="mt-1 w-full text-sm text-gray-600">
                            @error('image') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            <div wire:loading wire:target="image" class="mt-1 text-xs text-gray-400">Uploading…</div>
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="mt-2 h-16 rounded-lg object-cover">
                            @elseif ($currentImage)
                                <img src="{{ asset('storage/' . $currentImage) }}" class="mt-2 h-16 rounded-lg object-cover">
                            @endif
                        </div>

                        <div class="col-span-2 flex items-center gap-6">
                            <label class="flex cursor-pointer items-center gap-2">
                                <input wire:model="is_featured" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-slate-700">
                                <span class="text-sm font-medium text-gray-700">Featured</span>
                            </label>
                            <label class="flex cursor-pointer items-center gap-2">
                                <input wire:model="is_active" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-slate-700">
                                <span class="text-sm font-medium text-gray-700">Active</span>
                            </label>
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
