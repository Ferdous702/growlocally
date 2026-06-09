<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'client_name'     => $this->client_name,
            'client_position' => $this->client_position,
            'client_company'  => $this->client_company,
            'avatar_url'      => $this->client_avatar ? asset('storage/' . $this->client_avatar) : null,
            'content'         => $this->content,
            'rating'          => $this->rating,
            'service'         => $this->whenLoaded('service', fn () => [
                'title' => $this->service->title,
                'slug'  => $this->service->slug,
            ]),
        ];
    }
}
