<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateRequest;
use App\Models\State;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StateController extends Controller
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

        $states = State::SearchStates($q)
            ->paginate(10);

        return view('states.index')->with([
            'states' => $states
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones =  Zone::all()->sortBy("name");

        return view('states.create')->with([
            'zones' => $zones,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request, State $state)
    {
        $request->validated();

        $state->fill($request->all());
        $state->status = 1;
        $state->dtcr = now();
        $state->crby = Auth::user()->id;
        $state->dtlm = now();
        $state->lmby = Auth::user()->id;
        $state->save();
        return redirect()
            ->route('states.index')
            ->withSuccess("New State with id {$state->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $zones =  Zone::all()->sortBy("name");

        return view('states.edit')->with([
            'zones' => $zones,
            'state' => $state,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, State $state)
    {
        $request->validated();
        $state->fill($request->all());
        $state->dtlm = now();
        $state->lmby = Auth::user()->id;
        $state->save();

        return redirect()
            ->route('states.index')
            ->withSuccess("The State with id {$state->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        //
    }
}
