<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Services')]
class ServiceManager extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';
    public bool $showModal = false;
    public ?int $editingId = null;

    public string $title             = '';
    public string $slug              = '';
    public string $short_description = '';
    public string $description       = '';
    public string $icon              = '';
    public $image                    = null;
    public bool $is_featured         = false;
    public bool $is_active           = true;
    public ?string $currentImage     = null;

    public function updatedSearch(): void
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
        $service                   = Service::findOrFail($id);
        $this->editingId           = $id;
        $this->title               = $service->title;
        $this->slug                = $service->slug;
        $this->short_description   = $service->short_description ?? '';
        $this->description         = $service->description ?? '';
        $this->icon                = $service->icon ?? '';
        $this->currentImage        = $service->image;
        $this->is_featured         = $service->is_featured;
        $this->is_active           = $service->is_active;
        $this->showModal           = true;
    }

    public function save(): void
    {
        $this->validate([
            'title'             => ['required', 'string', 'max:255', Rule::unique('services', 'title')->ignore($this->editingId)],
            'slug'              => ['required', 'string', 'max:255', Rule::unique('services', 'slug')->ignore($this->editingId)],
            'short_description' => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'icon'              => 'nullable|string|max:255',
            'image'             => 'nullable|image|max:2048',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
        ]);

        $data = [
            'title'             => $this->title,
            'slug'              => $this->slug,
            'short_description' => $this->short_description ?: null,
            'description'       => $this->description ?: null,
            'icon'              => $this->icon ?: null,
            'is_featured'       => $this->is_featured,
            'is_active'         => $this->is_active,
        ];

        if ($this->image) {
            if ($this->currentImage) {
                Storage::disk('public')->delete($this->currentImage);
            }
            $data['image'] = $this->image->store('services', 'public');
        }

        if ($this->editingId) {
            Service::findOrFail($this->editingId)->update($data);
            $message = 'Service updated successfully.';
        } else {
            Service::create($data);
            $message = 'Service created successfully.';
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $message);
    }

    public function delete(int $id): void
    {
        $service = Service::findOrFail($id);

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();
        session()->flash('success', 'Service deleted.');
    }

    private function resetForm(): void
    {
        $this->reset(['editingId', 'title', 'slug', 'short_description', 'description', 'icon', 'currentImage']);
        $this->image       = null;
        $this->is_featured = false;
        $this->is_active   = true;
    }

    public function render()
    {
        return view('livewire.admin.service-manager', [
            'services' => Service::query()
                ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
                ->latest()
                ->paginate(10),
        ]);
    }
}
