<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrolledResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'price' => $this->price,
            'camp_benefits' => CampBenefitResource::collection($this->camp_benefits),
        ];
    }
}
