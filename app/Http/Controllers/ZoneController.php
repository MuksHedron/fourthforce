<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZoneRequest;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZoneController extends Controller
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

        $zones = Zone::SearchZones($q)
            ->paginate(10);

        return view('zones.index')->with([
            'zones' => $zones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoneRequest $request, Zone $zone)
    {
        $request->validated();

        $zone->fill($request->all());
        $zone->status = 1;
        $zone->dtcr = now();
        $zone->crby = Auth::user()->id;
        $zone->dtlm = now();
        $zone->lmby = Auth::user()->id;
        $zone->save();
        return redirect()
            ->route('zones.index')
            ->withSuccess("New Zone with id {$zone->id} was created");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    { 
        return view('zones.edit')->with([ 
            'zone' => $zone,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(ZoneRequest $request, Zone $zone)
    {
        $request->validated();
        $zone->fill($request->all());
        $zone->dtlm = now();
        $zone->lmby = Auth::user()->id;
        $zone->save();

        return redirect()
            ->route('zones.index')
            ->withSuccess("The Zone with id {$zone->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        //
    }
}
