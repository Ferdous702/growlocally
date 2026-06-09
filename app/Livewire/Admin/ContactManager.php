<?php

namespace App\Livewire\Admin;

use App\Models\ContactInquiry;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Contact Inquiries')]
class ContactManager extends Component
{
    use WithPagination;

    public string $search              = '';
    public bool $showModal             = false;
    public ?ContactInquiry $viewing    = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function view(int $id): void
    {
        $this->viewing   = ContactInquiry::findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->viewing   = null;
    }

    public function delete(int $id): void
    {
        ContactInquiry::findOrFail($id)->delete();

        if ($this->viewing?->id === $id) {
            $this->closeModal();
        }

        session()->flash('success', 'Inquiry deleted.');
    }

    public function render()
    {
        return view('livewire.admin.contact-manager', [
            'inquiries' => ContactInquiry::query()
                ->when($this->search, fn ($q) => $q
                    ->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%"))
                ->latest()
                ->paginate(15),
        ]);
    }
}
