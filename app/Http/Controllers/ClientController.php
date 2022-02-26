<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
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

        $clients = Client::SearchClients($q)
            ->paginate(10);

        return view('clients.index')->with([
            'clients' => $clients
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
        $states =  State::all()->sortBy("name");

        return view('clients.create')->with([
            'categories' => $categories,
            'cities' => $cities,
            'states' => $states,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request, Client $client)
    {
        $request->validated();

        $client->fill($request->all());
        $client->status = 1;
        $client->dtcr = now();
        $client->crby = Auth::user()->id;
        $client->dtlm = now();
        $client->lmby = Auth::user()->id;
        $client->save();
        return redirect()
            ->route('clients.index')
            ->withSuccess("New Client with id {$client->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $categories =  Category::all()->sortBy("name");
        $cities =  City::all()->sortBy("name");
        $states =  State::all()->sortBy("name");

        return view('clients.edit')->with([
            'categories' => $categories,
            'cities' => $cities,
            'states' => $states,
            'client' => $client,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $request->validated();

        $client->fill($request->all());
        $client->dtlm = now();
        $client->lmby = Auth::user()->id;
        $client->save();

        return redirect()
            ->route('clients.index')
            ->withSuccess("The Client with id {$client->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
