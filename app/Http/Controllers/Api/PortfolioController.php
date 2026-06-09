<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PortfolioController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $portfolios = Portfolio::published()
            ->with('category')
            ->when(request('featured'), fn ($q) => $q->featured())
            ->when(request('category'), function ($q) {
                $category = PortfolioCategory::where('slug', request('category'))->first();
                return $category ? $q->where('portfolio_category_id', $category->id) : $q;
            })
            ->latest()
            ->paginate(12);

        return PortfolioResource::collection($portfolios);
    }

    public function show(string $slug): PortfolioResource
    {
        $portfolio = Portfolio::published()->with('category')->where('slug', $slug)->firstOrFail();

        return new PortfolioResource($portfolio);
    }
}
