<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Testimonials')]
class TestimonialManager extends Component
{
    use WithPagination, WithFileUploads;

    public string $search       = '';
    public string $filterStatus = '';
    public bool $showModal      = false;
    public ?int $editingId      = null;

    public ?int $service_id       = null;
    public string $client_name    = '';
    public string $client_position = '';
    public string $client_company = '';
    public $client_avatar         = null;
    public string $content        = '';
    public int $rating            = 5;
    public string $status         = 'pending';
    public ?string $currentAvatar = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function openCreate(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $t                      = Testimonial::findOrFail($id);
        $this->editingId        = $id;
        $this->service_id       = $t->service_id;
        $this->client_name      = $t->client_name ?? '';
        $this->client_position  = $t->client_position ?? '';
        $this->client_company   = $t->client_company ?? '';
        $this->currentAvatar    = $t->client_avatar;
        $this->content          = $t->content ?? '';
        $this->rating           = $t->rating;
        $this->status           = $t->status;
        $this->showModal        = true;
    }

    public function save(): void
    {
        $this->validate([
            'service_id'      => 'nullable|exists:services,id',
            'client_name'     => 'nullable|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'client_company'  => 'nullable|string|max:255',
            'client_avatar'   => 'nullable|image|max:1024',
            'content'         => 'nullable|string',
            'rating'          => 'required|integer|min:1|max:5',
            'status'          => 'required|in:pending,approved',
        ]);

        $data = [
            'service_id'      => $this->service_id,
            'client_name'     => $this->client_name ?: null,
            'client_position' => $this->client_position ?: null,
            'client_company'  => $this->client_company ?: null,
            'content'         => $this->content ?: null,
            'rating'          => $this->rating,
            'status'          => $this->status,
        ];

        if ($this->client_avatar) {
            if ($this->currentAvatar) {
                Storage::disk('public')->delete($this->currentAvatar);
            }
            $data['client_avatar'] = $this->client_avatar->store('testimonials', 'public');
        }

        if ($this->editingId) {
            Testimonial::findOrFail($this->editingId)->update($data);
            $message = 'Testimonial updated.';
        } else {
            Testimonial::create($data);
            $message = 'Testimonial created.';
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $message);
    }

    public function toggleApproval(int $id): void
    {
        $t = Testimonial::findOrFail($id);
        $t->update(['status' => $t->status === 'approved' ? 'pending' : 'approved']);
    }

    public function delete(int $id): void
    {
        $t = Testimonial::findOrFail($id);

        if ($t->client_avatar) {
            Storage::disk('public')->delete($t->client_avatar);
        }

        $t->delete();
        session()->flash('success', 'Testimonial deleted.');
    }

    private function resetForm(): void
    {
        $this->reset(['editingId', 'service_id', 'client_name', 'client_position', 'client_company', 'content', 'currentAvatar']);
        $this->client_avatar = null;
        $this->rating        = 5;
        $this->status        = 'pending';
    }

    public function render()
    {
        return view('livewire.admin.testimonial-manager', [
            'testimonials' => Testimonial::query()
                ->with('service')
                ->when($this->search, fn ($q) => $q->where('client_name', 'like', "%{$this->search}%"))
                ->when($this->filterStatus, fn ($q) => $q->where('status', $this->filterStatus))
                ->latest()
                ->paginate(10),
            'services' => Service::active()->orderBy('title')->get(),
        ]);
    }
}
