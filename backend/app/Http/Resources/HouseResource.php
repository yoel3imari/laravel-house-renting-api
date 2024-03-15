<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "location_latitude" => $this->location_latitude,
            "location_longitude" => $this->location_longitude,
            "images" => $this->images,
            "nbr_bedroom" => $this->nbr_bedroom,
            "nbr_bath" => $this->nbr_bath,
            "wifi" => $this->wifi,
            "is_equipped" => $this->is_equipped,
            "is_furnished" => $this->is_furnished,
            "surface" => $this->surface,
            "type" => $this->type,
            "desc" => $this->desc,
            "title" => $this->title,
            "rent_by" => $this->rent_by,
            "rent_price" => $this->rent_price,
            "user_id" => $this->user_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
