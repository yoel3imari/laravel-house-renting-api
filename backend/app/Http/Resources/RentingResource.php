<?php

namespace App\Http\Resources;

use App\Models\House;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $house = House::findOrFail($this->house_id);
        $user = User::findOrFail($this->user_id);
        
        return [
            "id" => $this->id,
            "started_at" => $this->started_at,
            "ended_at" => $this->ended_at,
            "rent_price" => $this->rent_price,
            "rent_by" => $house->rent_by,
            "house" => new HouseResource($house),
            "user" => new UserResource($user),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
