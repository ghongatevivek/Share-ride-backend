<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'destination_name' => 'required',
        ]);

        return $request->user()->trips()->create($request->only([
            'origin', 
            'destination',
            'destination_name'
        ]));
    }

    public function show(Request $request, Trip $trip)
    {
        if($trip->user->id == $request->user()->id){
            return $trip;
        }
        
        if($trip->driver && $request->user()->driver){
            if($trip->driver->id === $request->user()->driver->id){
                return $trip;
            }
        }

        return response()->json(['message' => 'Cannot find trip'], 404);
    }
}