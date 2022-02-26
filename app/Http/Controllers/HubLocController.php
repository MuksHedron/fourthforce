<?php

namespace App\Http\Controllers;

use App\Http\Requests\HubLocRequest;
use App\Models\Hub;
use App\Models\HubLoc;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HubLocController extends Controller
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

        $hublocs = HubLoc::SearchHubLocs($q)
            ->paginate(10);

        return view('hublocs.index')->with([
            'hublocs' => $hublocs
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
        $hubs =  Hub::all()->sortBy("name");

        return view('hublocs.create')->with([
            'locations' => $locations,
            'hubs' => $hubs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HubLocRequest $request, HubLoc $hubloc)
    {
        $request->validated();

        $hubloc->fill($request->all());
        $hubloc->status = 1;
        $hubloc->dtcr = now();
        $hubloc->crby = Auth::user()->id;
        $hubloc->dtlm = now();
        $hubloc->lmby = Auth::user()->id;
        $hubloc->save();
        return redirect()
            ->route('hublocs.index')
            ->withSuccess("New Hub Location with id {$hubloc->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HubLoc  $hubLoc
     * @return \Illuminate\Http\Response
     */
    public function show(HubLoc $hubLoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HubLoc  $hubLoc
     * @return \Illuminate\Http\Response
     */
    public function edit(HubLoc $hubloc)
    {
        $locations =  Location::all()->sortBy("name");
        $hubs =  Hub::all()->sortBy("name");

        return view('hublocs.edit')->with([
            'locations' => $locations,
            'hubs' => $hubs,
            'hubloc' => $hubloc,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HubLoc  $hubLoc
     * @return \Illuminate\Http\Response
     */
    public function update(HubLocRequest $request, HubLoc $hubloc)
    {
        $request->validated();
        $hubloc->fill($request->all());
        $hubloc->dtlm = now();
        $hubloc->lmby = Auth::user()->id;
        $hubloc->save();

        return redirect()
            ->route('hublocs.index')
            ->withSuccess("The Hub Location with id {$hubloc->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HubLoc  $hubLoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(HubLoc $hubloc)
    {
        //
    }
}
