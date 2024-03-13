<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\HouseStoreRequest;
use App\Http\Resources\HouseResource;
use App\Http\Services\LocationService;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $location = $request->get("location"); // for location and description
        $nbr_bedroom = $request->get("nbr_bedroom");
        $nbr_bath = $request->get("nbr_bath");
        $wifi = $request->get("wifi");
        $is_equipped = $request->get("is_equipped");
        $is_furnished = $request->get("is_furnished");
        $surface = $request->get("surface");
        $type = $request->get("type");
        $rent_by = $request->get("rent_by");
        $rent_price = $request->get("rent_price");


        $query = House::query();

        $query->where(function ($query) use ($location, $nbr_bedroom, $nbr_bath, $wifi, $is_equipped, $is_furnished, $surface, $type, $rent_by, $rent_price) {
            if ($location) {

                if (is_array($location)) {
                    $query = LocationService::houses_near_location($query, $location);
                } else if (is_string($location)) {
                    $query->orWhere('title', 'like', '%' . $location . '%');
                    $query->orWhere('desc', 'like', '%' . $location . '%');
                }

            }

            if($nbr_bath) $query->orWhere('nbr_bath', '<=', $nbr_bath);
            if($nbr_bedroom) $query->orWhere('nbr_bedroom', '<=', $nbr_bedroom);
            if($wifi) $query->orWhere('wifi', $wifi);
            if($is_equipped) $query->orWhere('is_equipped', $is_equipped);
            if($is_furnished) $query->orWhere('is_furnished', $is_furnished);
            if($surface) $query->orWhere('surface', '<=', $surface);
            if($type) $query->orWhere('type', $type);
            if($rent_by) $query->orWhere('rent_by', $rent_by);
            if($rent_price) $query->orWhereBetween('rent_price', [$rent_price[0], $rent_price[1]]);
        });

        return HouseResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HouseStoreRequest $request)
    {
        //validation
        // validated automaticaly

        // create object
        $house = House::create([
            "location_latitude" => $request->location_latitude,
            "location_longitude" => $request->location_longitude,
            "images" => json_decode($request->images),
            "nbr_bedroom" => $request->nbr_bedroom,
            "nbr_bath" => $request->nbr_bath,
            "wifi" => $request->wifi,
            "is_equipped" => $request->is_equipped,
            "is_furnished" => $request->is_furnished,
            "surface" => $request->surface,
            "type" => $request->type,
            "desc" => $request->desc,
            "rent_by" => $request->rent_by,
            "rent_price" => $request->rent_price,
            "user_id" => $request->user_id,
        ]);

        // return new record
        return response()->json([
            "message" => "HouseCreatedSuccess",
            "data" => new HouseResource($house)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house): HouseResource
    {
        return new HouseResource($house);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // get record
        $house = House::findOrFail($id);

        // update fields
        $house->update($request->all());

        // return record
        return response()->json([
            "message" => "HouseUpdatedSuccess",
            "data" => new HouseResource($house)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // get record
        $house = House::findOrFail($id);

        // delete it
        $house->delete();

        // return response
        return response()->json([
            "message" => "HouseDeletedSuccess",
        ]);
    }
}
