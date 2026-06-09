<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TestimonialController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $testimonials = Testimonial::approved()
            ->with('service')
            ->when(request('service'), function ($q) {
                return $q->whereHas('service', fn ($s) => $s->where('slug', request('service')));
            })
            ->latest()
            ->paginate(10);

        return TestimonialResource::collection($testimonials);
    }
}
