<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'slug'          => $this->slug,
            'client_name'   => $this->client_name,
            'description'   => $this->description,
            'thumbnail_url' => $this->thumbnail ? asset('storage/' . $this->thumbnail) : null,
            'project_url'   => $this->project_url,
            'is_featured'   => $this->is_featured,
            'status'        => $this->status,
            'category'      => $this->whenLoaded('category', fn () => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ]),
        ];
    }
}
