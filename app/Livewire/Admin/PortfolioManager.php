<?php

namespace App\Livewire\Admin;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Portfolios')]
class PortfolioManager extends Component
{
    use WithPagination, WithFileUploads;

    public string $search        = '';
    public string $filterStatus  = '';
    public bool $showModal       = false;
    public ?int $editingId       = null;

    public ?int $portfolio_category_id = null;
    public string $title               = '';
    public string $slug                = '';
    public string $client_name         = '';
    public string $description         = '';
    public $thumbnail                  = null;
    public string $project_url         = '';
    public bool $is_featured           = false;
    public string $status              = 'draft';
    public ?string $currentThumbnail   = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function updatedTitle(): void
    {
        if (! $this->editingId) {
            $this->slug = Str::slug($this->title);
        }
    }

    public function openCreate(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $portfolio                       = Portfolio::findOrFail($id);
        $this->editingId                 = $id;
        $this->portfolio_category_id     = $portfolio->portfolio_category_id;
        $this->title                     = $portfolio->title;
        $this->slug                      = $portfolio->slug;
        $this->client_name               = $portfolio->client_name ?? '';
        $this->description               = $portfolio->description ?? '';
        $this->currentThumbnail          = $portfolio->thumbnail;
        $this->project_url               = $portfolio->project_url ?? '';
        $this->is_featured               = $portfolio->is_featured;
        $this->status                    = $portfolio->status;
        $this->showModal                 = true;
    }

    public function save(): void
    {
        $this->validate([
            'portfolio_category_id' => 'nullable|exists:portfolio_categories,id',
            'title'                 => ['required', 'string', 'max:255'],
            'slug'                  => ['required', 'string', 'max:255', Rule::unique('portfolios', 'slug')->ignore($this->editingId)],
            'client_name'           => 'nullable|string|max:255',
            'description'           => 'nullable|string',
            'thumbnail'             => 'nullable|image|max:2048',
            'project_url'           => 'nullable|url|max:255',
            'is_featured'           => 'boolean',
            'status'                => 'required|in:draft,published',
        ]);

        $data = [
            'portfolio_category_id' => $this->portfolio_category_id,
            'title'                 => $this->title,
            'slug'                  => $this->slug,
            'client_name'           => $this->client_name ?: null,
            'description'           => $this->description ?: null,
            'project_url'           => $this->project_url ?: null,
            'is_featured'           => $this->is_featured,
            'status'                => $this->status,
        ];

        if ($this->thumbnail) {
            if ($this->currentThumbnail) {
                Storage::disk('public')->delete($this->currentThumbnail);
            }
            $data['thumbnail'] = $this->thumbnail->store('portfolios', 'public');
        }

        if ($this->editingId) {
            Portfolio::findOrFail($this->editingId)->update($data);
            $message = 'Portfolio updated.';
        } else {
            Portfolio::create($data);
            $message = 'Portfolio created.';
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $message);
    }

    public function delete(int $id): void
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->thumbnail) {
            Storage::disk('public')->delete($portfolio->thumbnail);
        }

        $portfolio->delete();
        session()->flash('success', 'Portfolio deleted.');
    }

    private function resetForm(): void
    {
        $this->reset(['editingId', 'portfolio_category_id', 'title', 'slug', 'client_name', 'description', 'project_url', 'is_featured', 'currentThumbnail']);
        $this->thumbnail = null;
        $this->status    = 'draft';
    }

    public function render()
    {
        return view('livewire.admin.portfolio-manager', [
            'portfolios' => Portfolio::query()
                ->with('category')
                ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
                ->when($this->filterStatus, fn ($q) => $q->where('status', $this->filterStatus))
                ->latest()
                ->paginate(10),
            'categories' => PortfolioCategory::orderBy('name')->get(),
        ]);
    }
}
