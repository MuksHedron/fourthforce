<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStateRequest;
use App\Models\Client;
use App\Models\ClientState;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientStateController extends Controller
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

        $clientstates = ClientState::SearchClientStates($q)
            ->paginate(10);

        return view('clientstates.index')->with([
            'clientstates' => $clientstates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients =  Client::all()->sortBy("name");
        $states =  State::all()->sortBy("name");

        return view('clientstates.create')->with([
            'clients' => $clients,
            'states' => $states,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStateRequest $request, ClientState $clientstate)
    {
        $request->validated();

        $clientstate->fill($request->all());
        $clientstate->status = 1;
        $clientstate->dtcr = now();
        $clientstate->crby = Auth::user()->id;
        $clientstate->dtlm = now();
        $clientstate->lmby = Auth::user()->id;
        $clientstate->save();
        return redirect()
            ->route('clientstates.index')
            ->withSuccess("New Client State with id {$clientstate->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientState  $clientState
     * @return \Illuminate\Http\Response
     */
    public function show(ClientState $clientState)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientState  $clientState
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientState $clientstate)
    {
        $clients =  Client::all()->sortBy("name");
        $states =  State::all()->sortBy("name");

        return view('clientstates.edit')->with([
            'clients' => $clients,
            'states' => $states,
            'clientstate' => $clientstate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientState  $clientState
     * @return \Illuminate\Http\Response
     */
    public function update(ClientStateRequest $request, ClientState $clientstate)
    {
        $request->validated();
        $clientstate->fill($request->all());
        $clientstate->dtlm = now();
        $clientstate->lmby = Auth::user()->id;
        $clientstate->save();

        return redirect()
            ->route('clientstates.index')
            ->withSuccess("The Client State with id {$clientstate->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientState  $clientState
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientState $clientstate)
    {
        //
    }
}
