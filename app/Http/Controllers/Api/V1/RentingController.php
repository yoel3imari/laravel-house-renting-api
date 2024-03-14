<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RentingResource;
use App\Models\Renting;
use Illuminate\Http\Request;

class RentingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $rentings = Renting::all();
        $house_id = $request->get("house_id");
        $user_id = $request->get("user_id");
        $started_at = $request->get("started_at");
        $ended_at = $request->get("ended_at");
        $rent_price = $request->get("rent_price");
        $rent_by = $request->get("rent_by");
        $date_range = $request->get("date_range");

        $query = Renting::query();

        if( $house_id ) $query->orWhere("house_id", $house_id);
        if( $user_id ) $query->orWhere("user_id", $user_id);
        if( $started_at ) $query->orWhere("started_at",$started_at);
        if( $ended_at ) $query->orWhere("ended_at", $ended_at);
        if( $rent_price ) $query->orWhereBetween("rent_price", [$rent_price[0], $rent_price[1]]);
        if( $rent_by ) $query->orWhere("rent_by", $rent_by); 
        if( $date_range ) $query->orWhereBetween("updated_at", [$date_range[0], $date_range[1]]);

        return RentingResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $renting = Renting::create($request->all());
        return response()->json([
            "message" => "RentedSuccessfull",
            "data" => $renting,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Renting $renting)
    {
        return new RentingResource($renting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $renting = Renting::findOrFail($id);
        $renting->update($request->all());
        return response()->json([
            "message" => "RentingUpdated",
            "data" => $renting,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $renting = Renting::findOrFail($id);
        $renting->delete();
        return response()->json([
            "message" => "RentingDeleted",
        ]);
    }
}
