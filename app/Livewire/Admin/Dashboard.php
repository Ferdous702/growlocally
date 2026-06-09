<?php

namespace App\Livewire\Admin;

use App\Models\ContactInquiry;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Testimonial;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'stats' => [
                'services'     => Service::count(),
                'portfolios'   => Portfolio::count(),
                'testimonials' => Testimonial::count(),
                'inquiries'    => ContactInquiry::count(),
            ],
        ]);
    }
}
