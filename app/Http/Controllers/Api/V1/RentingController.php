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
    public function index()
    {
        // $rentings = Renting::all();
        return RentingResource::collection(Renting::all());
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
