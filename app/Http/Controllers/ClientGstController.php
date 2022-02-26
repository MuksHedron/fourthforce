<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientGstRequest;
use App\Models\Client;
use App\Models\ClientGst;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientGstController extends Controller
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

        $clientgsts = ClientGst::SearchClientGsts($q)
            ->paginate(10);

        return view('clientgsts.index')->with([
            'clientgsts' => $clientgsts
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

        return view('clientgsts.create')->with([
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
    public function store(ClientGstRequest $request, ClientGst $clientgst)
    {
        $request->validated();

        $clientgst->fill($request->all());
        $clientgst->status = 1;
        $clientgst->dtcr = now();
        $clientgst->crby = Auth::user()->id;
        $clientgst->dtlm = now();
        $clientgst->lmby = Auth::user()->id;
        $clientgst->save();
        return redirect()
            ->route('clientgst.index')
            ->withSuccess("New Client Gst with id {$clientgst->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientGst  $clientGst
     * @return \Illuminate\Http\Response
     */
    public function show(ClientGst $clientGst)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientGst  $clientGst
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientGst $clientgst)
    {
        $clients =  Client::all()->sortBy("name");
        $states =  State::all()->sortBy("name");

        return view('clientgsts.edit')->with([
            'clients' => $clients,
            'states' => $states,
            'clientgst' => $clientgst,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientGst  $clientGst
     * @return \Illuminate\Http\Response
     */
    public function update(ClientGstRequest $request, ClientGst $clientgst)
    {
        $request->validated();
        $clientgst->fill($request->all());
        $clientgst->dtlm = now();
        $clientgst->lmby = Auth::user()->id;
        $clientgst->save();

        return redirect()
            ->route('clientgsts.index')
            ->withSuccess("The Client Gst with id {$clientgst->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientGst  $clientGst
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientGst $clientgst)
    {
        //
    }
}
