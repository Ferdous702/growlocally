<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ServiceController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $services = Service::active()
            ->when(request('featured'), fn ($q) => $q->featured())
            ->latest()
            ->paginate(10);

        return ServiceResource::collection($services);
    }

    public function show(string $slug): ServiceResource
    {
        $service = Service::active()->where('slug', $slug)->firstOrFail();

        return new ServiceResource($service);
    }
}
