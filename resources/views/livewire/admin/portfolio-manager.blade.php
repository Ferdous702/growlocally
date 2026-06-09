<div>
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div class="flex gap-3">
            <input wire:model.live.debounce.300ms="search"
                   type="search" placeholder="Search portfolios…"
                   class="w-64 rounded-lg border border-gray-300 px-4 py-2 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
            <select wire:model.live="filterStatus"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                <option value="">All Statuses</option>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>
        <button wire:click="openCreate"
                class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">
            + New Portfolio
        </button>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-6 py-3 text-left">Title</th>
                    <th class="px-6 py-3 text-left">Category</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Featured</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($portfolios as $portfolio)
                    <tr class="transition hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if ($portfolio->thumbnail)
                                    <img src="{{ asset('storage/' . $portfolio->thumbnail) }}"
                                         class="h-9 w-9 rounded-lg object-cover" alt="">
                                @else
                                    <div class="h-9 w-9 rounded-lg bg-gray-100"></div>
                                @endif
                                <div>
                                    <p class="font-medium text-gray-900">{{ $portfolio->title }}</p>
                                    @if ($portfolio->client_name)
                                        <p class="text-xs text-gray-400">{{ $portfolio->client_name }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $portfolio->category?->name ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                         {{ $portfolio->status === 'published' ? 'bg-green-50 text-green-700' : 'bg-yellow-50 text-yellow-700' }}">
                                {{ ucfirst($portfolio->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if ($portfolio->is_featured)
                                <span class="inline-flex items-center rounded-full bg-yellow-50 px-2.5 py-0.5 text-xs font-medium text-yellow-700">Yes</span>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="openEdit({{ $portfolio->id }})"
                                    class="mr-3 text-sm font-medium text-blue-600 hover:text-blue-800">Edit</button>
                            <button wire:click="delete({{ $portfolio->id }})"
                                    wire:confirm="Delete '{{ $portfolio->title }}'?"
                                    class="text-sm font-medium text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-400">No portfolios found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($portfolios->hasPages())
            <div class="border-t border-gray-100 px-6 py-4">{{ $portfolios->links() }}</div>
        @endif
    </div>

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
             x-data @click.self="$wire.set('showModal', false)"
             @keydown.escape.window="$wire.set('showModal', false)">
            <div class="w-full max-w-2xl rounded-xl bg-white shadow-2xl">

                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h2 class="text-base font-semibold text-gray-900">
                        {{ $editingId ? 'Edit Portfolio' : 'New Portfolio' }}
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

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select wire:model="portfolio_category_id"
                                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                                <option value="">— None —</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Client Name</label>
                            <input wire:model="client_name" type="text"
                                   class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea wire:model="description" rows="4"
                                      class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Thumbnail</label>
                            <input wire:model="thumbnail" type="file" accept="image/*"
                                   class="mt-1 w-full text-sm text-gray-600">
                            @error('thumbnail') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            <div wire:loading wire:target="thumbnail" class="mt-1 text-xs text-gray-400">Uploading…</div>
                            @if ($thumbnail)
                                <img src="{{ $thumbnail->temporaryUrl() }}" class="mt-2 h-16 rounded-lg object-cover">
                            @elseif ($currentThumbnail)
                                <img src="{{ asset('storage/' . $currentThumbnail) }}" class="mt-2 h-16 rounded-lg object-cover">
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Project URL</label>
                            <input wire:model="project_url" type="url" placeholder="https://"
                                   class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                            @error('project_url') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                            <select wire:model="status"
                                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>

                        <div class="flex items-end pb-1">
                            <label class="flex cursor-pointer items-center gap-2">
                                <input wire:model="is_featured" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-slate-700">
                                <span class="text-sm font-medium text-gray-700">Featured</span>
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
