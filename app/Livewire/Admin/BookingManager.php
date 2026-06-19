<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Bookings')]
class BookingManager extends Component
{
    use WithPagination;

    public string $search   = '';
    public string $status   = '';
    public bool $showModal  = false;
    public ?Booking $viewing = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function view(int $id): void
    {
        $this->viewing   = Booking::findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->viewing   = null;
    }

    public function updateStatus(int $id, string $status): void
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $status]);

        if ($this->viewing?->id === $id) {
            $this->viewing = $booking->fresh();
        }

        session()->flash('success', 'Booking status updated.');
    }

    public function delete(int $id): void
    {
        Booking::findOrFail($id)->delete();

        if ($this->viewing?->id === $id) {
            $this->closeModal();
        }

        session()->flash('success', 'Booking deleted.');
    }

    public function render()
    {
        return view('livewire.admin.booking-manager', [
            'bookings' => Booking::query()
                ->when($this->search, fn ($q) => $q
                    ->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('business_name', 'like', "%{$this->search}%"))
                ->when($this->status, fn ($q) => $q->where('status', $this->status))
                ->latest()
                ->paginate(15),
            'counts' => [
                'pending'   => Booking::where('status', 'pending')->count(),
                'confirmed' => Booking::where('status', 'confirmed')->count(),
                'cancelled' => Booking::where('status', 'cancelled')->count(),
            ],
        ]);
    }
}
