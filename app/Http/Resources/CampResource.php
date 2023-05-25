<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'price' => $this->price,
            'image' => $this->image,
            'camp_benefits' => CampBenefitResource::collection($this->camp_benefits),
            'enrolls' => EnrollResource::collection($this->enrolls)->where('is_completed', false),
        ];
    }
}
