<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
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
        $citiesdata = City::SearchCities($q)->get();

        return view('cities.index')->with([
			'citiesdata' => $citiesdata,
			
        ]);
    }
	public function cityData(Request $request)
	{
		$citiesdata['data'] = City::with('states')->get();
		return json_encode($citiesdata);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states =  State::all()->sortBy("name");

        return view('cities.create')->with([
            'states' => $states,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request, City $city)
    {
        $request->validated();

        $city->fill($request->all());
        $city->status = 1;
        $city->dtcr = now();
        $city->crby = Auth::user()->id;
        $city->dtlm = now();
        $city->lmby = Auth::user()->id;
        $city->save();
        return redirect()
            ->route('cities.index')
            ->withSuccess("New City with id {$city->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $states =  State::all()->sortBy("name");

        return view('cities.edit')->with([
            'states' => $states,
            'city' => $city,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        $request->validated();
        $city->fill($request->all());
        $city->dtlm = now();
        $city->lmby = Auth::user()->id;
        $city->save();

        return redirect()
            ->route('cities.index')
            ->withSuccess("The City with id {$city->id} was updated");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
