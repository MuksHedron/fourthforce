<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaRequest;
use App\Models\Area;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
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

        $areas = Area::SearchAreas($q)
            ->paginate(10);

        return view('areas.index')->with([
            'areas' => $areas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations =  Location::all()->sortBy("name");

        return view('areas.create')->with([
            'locations' => $locations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request, Area $area)
    {
        $request->validated();

        $area->fill($request->all());
        $area->status = 1;
        $area->dtcr = now();
        $area->crby = Auth::user()->id;
        $area->dtlm = now();
        $area->lmby = Auth::user()->id;
        $area->save();
        return redirect()
            ->route('areas.index')
            ->withSuccess("New Area with id {$area->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        $locations =  Location::all()->sortBy("name");
        return view('areas.edit')->with([
            'locations' => $locations,
            'area' => $area,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, Area $area)
    {
        $request->validated();
        $area->fill($request->all());
        $area->dtlm = now();
        $area->lmby = Auth::user()->id;
        $area->save();

        return redirect()
            ->route('areas.index')
            ->withSuccess("The Area with id {$area->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}
