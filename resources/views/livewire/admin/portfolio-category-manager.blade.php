<div>
    <div class="mb-6 flex items-center justify-between gap-4">
        <input wire:model.live.debounce.300ms="search"
               type="search" placeholder="Search categories…"
               class="w-72 rounded-lg border border-gray-300 px-4 py-2 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
        <button wire:click="openCreate"
                class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">
            + New Category
        </button>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-sm">
            <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Slug</th>
                    <th class="px-6 py-3 text-left">Portfolios</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($categories as $category)
                    <tr class="transition hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $category->name }}</td>
                        <td class="px-6 py-4 font-mono text-xs text-gray-400">{{ $category->slug }}</td>
                        <td class="px-6 py-4">
                            <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600">
                                {{ $category->portfolios_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="openEdit({{ $category->id }})"
                                    class="mr-3 text-sm font-medium text-blue-600 hover:text-blue-800">Edit</button>
                            <button wire:click="delete({{ $category->id }})"
                                    wire:confirm="Delete '{{ $category->name }}'?"
                                    class="text-sm font-medium text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-sm text-gray-400">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($categories->hasPages())
            <div class="border-t border-gray-100 px-6 py-4">{{ $categories->links() }}</div>
        @endif
    </div>

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
             x-data @click.self="$wire.set('showModal', false)"
             @keydown.escape.window="$wire.set('showModal', false)">
            <div class="w-full max-w-md rounded-xl bg-white shadow-2xl">

                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h2 class="text-base font-semibold text-gray-900">
                        {{ $editingId ? 'Edit Category' : 'New Category' }}
                    </h2>
                    <button wire:click="$set('showModal', false)" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form wire:submit="save" class="px-6 py-5 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                        <input wire:model.blur="name" type="text" autofocus
                               class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                        @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Slug <span class="text-red-500">*</span></label>
                        <input wire:model="slug" type="text"
                               class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-mono outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/20">
                        @error('slug') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3 border-t border-gray-100 pt-4">
                        <button type="button" wire:click="$set('showModal', false)"
                                class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit"
                                class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">
                            {{ $editingId ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
