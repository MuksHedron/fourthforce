<?php

namespace App\Http\Controllers;

use App\Http\Requests\HubRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Hub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HubController extends Controller
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

        $hubs = Hub::SearchHubs($q)
            ->paginate(10);

        return view('hubs.index')->with([
            'hubs' => $hubs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  Category::all()->sortBy("name");
        $cities =  City::all()->sortBy("name");

        return view('hubs.create')->with([
            'categories' => $categories,
            'cities' => $cities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HubRequest $request, Hub $hub)
    {
        $request->validated();

        $hub->fill($request->all());
        $hub->status = 1;
        $hub->dtcr = now();
        $hub->crby = Auth::user()->id;
        $hub->dtlm = now();
        $hub->lmby = Auth::user()->id;
        $hub->save();
        return redirect()
            ->route('hubs.index')
            ->withSuccess("New Hub with id {$hub->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hub  $hub
     * @return \Illuminate\Http\Response
     */
    public function show(Hub $hub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hub  $hub
     * @return \Illuminate\Http\Response
     */
    public function edit(Hub $hub)
    {
        $categories =  Category::all()->sortBy("name");
        $cities =  City::all()->sortBy("name");

        return view('hubs.edit')->with([
            'categories' => $categories,
            'cities' => $cities,
            'hub' => $hub,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hub  $hub
     * @return \Illuminate\Http\Response
     */
    public function update(HubRequest $request, Hub $hub)
    {
        $request->validated();
        $hub->fill($request->all());
        $hub->dtlm = now();
        $hub->lmby = Auth::user()->id;
        $hub->save();

        return redirect()
            ->route('hubs.index')
            ->withSuccess("The Hub with id {$hub->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hub  $hub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hub $hub)
    {
        //
    }
}
