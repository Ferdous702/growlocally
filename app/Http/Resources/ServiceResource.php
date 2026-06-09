<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'slug'              => $this->slug,
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'icon'              => $this->icon,
            'image_url'         => $this->image ? asset('storage/' . $this->image) : null,
            'is_featured'       => $this->is_featured,
        ];
    }
}
