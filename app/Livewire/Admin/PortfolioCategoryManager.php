<?php

namespace App\Livewire\Admin;

use App\Models\PortfolioCategory;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Portfolio Categories')]
class PortfolioCategoryManager extends Component
{
    use WithPagination;

    public string $search    = '';
    public bool $showModal   = false;
    public ?int $editingId   = null;

    public string $name = '';
    public string $slug = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedName(): void
    {
        if (! $this->editingId) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function openCreate(): void
    {
        $this->reset(['name', 'slug', 'editingId']);
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $category        = PortfolioCategory::findOrFail($id);
        $this->editingId = $id;
        $this->name      = $category->name;
        $this->slug      = $category->slug;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('portfolio_categories', 'slug')->ignore($this->editingId)],
        ]);

        $data = ['name' => $this->name, 'slug' => $this->slug];

        if ($this->editingId) {
            PortfolioCategory::findOrFail($this->editingId)->update($data);
            $message = 'Category updated.';
        } else {
            PortfolioCategory::create($data);
            $message = 'Category created.';
        }

        $this->showModal = false;
        $this->reset(['name', 'slug', 'editingId']);
        session()->flash('success', $message);
    }

    public function delete(int $id): void
    {
        PortfolioCategory::findOrFail($id)->delete();
        session()->flash('success', 'Category deleted.');
    }

    public function render()
    {
        return view('livewire.admin.portfolio-category-manager', [
            'categories' => PortfolioCategory::query()
                ->withCount('portfolios')
                ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->latest()
                ->paginate(10),
        ]);
    }
}
