<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use App\Models\ClientState;
use App\Models\Lob;
use App\Models\Location;
use App\Models\State;
use App\Models\SubLob;
use App\Models\Zone;
use Illuminate\Http\Request;

class DropdownController extends Controller
{

    // public function getClients(Request $request)
    // {
    //     $clients = Client::all()->sortBy("name");
    //     return response()->json($clients);
    // }

    // public function getLobs(Request $request)
    // {
    //     $lobs = Lob::all()->sortBy("name");
    //     return response()->json($lobs);
    // }

    public function getSubLobs(Request $request)
    {
        $sublobs = SubLob::where("lobid", $request->lob_id)
            ->pluck("name", "id");
        return response()->json($sublobs);
    }

    public function getZones(Request $request)
    {
        $zones = Zone::all()->sortBy("name");
        return response()->json($zones);
    }

    public function getStatesFromZones(Request $request)
    {
        $states = State::where("zoneid", $request->zone_id)
            ->pluck("name", "id");
        return response()->json($states);
    }

    public function getStates(Request $request)
    {
        $states = State::all()->sortBy("name");
        return response()->json($states);
    }


    public function getCities(Request $request)
    {
        $cities = City::where("stateid", $request->state_id)
            ->pluck("name", "id");
        return response()->json($cities);
    }

    public function getLocations(Request $request)
    {
        $locations = Location::where("cityid", $request->city_id)
            ->pluck("name", "id");
        return response()->json($locations);
    }


    // public function getclientstates(Request $request)
    // {
    //     $states = ClientState::all()->sortBy("states.name");
    //     return response()->json($states);
    // }


}
