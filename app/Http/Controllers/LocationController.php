<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\City;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = null;

        if ($request->has('q')) $q = $request->query('q');

        $locations = Location::SearchLocations($q)
            ->paginate(10);

        return view('locations.index')->with([
            'locations' => $locations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cities = City::all()->sortBy("name");  
        return view('locations.create')->with([
            'cities' => $cities, 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request, Location $location)
    {
        $request->validated();

        $location->fill($request->all());
        $location->status = 1;
        $location->dtcr = now();
        $location->crby = Auth::user()->id;
        $location->dtlm = now();
        $location->lmby = Auth::user()->id;
        $location->save();
        return redirect()
            ->route('locations.index')
            ->withSuccess("New Location with id {$location->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        $cities = City::all()->sortBy("name");  
        return view('locations.edit')->with([
            'location' => $location, 
            'cities' => $cities, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, Location $location)
    {
        $request->validated();
        $location->fill($request->all());
        $location->dtlm = now();
        $location->lmby = Auth::user()->id;
        $location->save();

        return redirect()
            ->route('locations.index')
            ->withSuccess("The Location with id {$location->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}
