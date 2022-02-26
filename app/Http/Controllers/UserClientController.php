<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserClientRequest;
use App\Models\Client;
use App\Models\User;
use App\Models\UserClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserClientController extends Controller
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

        $userclients = UserClient::SearchUserClients($q)
            ->paginate(10);

        return view('userclients.index')->with([
            'userclients' => $userclients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users =  User::all()->sortBy("name");
        $clients =  Client::all()->sortBy("name");

        return view('userclients.create')->with([
            'users' => $users,
            'clients' => $clients,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserClientRequest $request, UserClient $userclient)
    {
        $request->validated();

        $userclient->fill($request->all());
        $userclient->status = 1;
        $userclient->dtcr = now();
        $userclient->crby = Auth::user()->id;
        $userclient->dtlm = now();
        $userclient->lmby = Auth::user()->id;
        $userclient->save();
        return redirect()
            ->route('userclients.index')
            ->withSuccess("New User Client with id {$userclient->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserClient  $userClient
     * @return \Illuminate\Http\Response
     */
    public function show(UserClient $userclient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserClient  $userClient
     * @return \Illuminate\Http\Response
     */
    public function edit(UserClient $userclient)
    {
        $users =  User::all()->sortBy("name");
        $clients =  Client::all()->sortBy("name");

        return view('userclients.edit')->with([
            'users' => $users,
            'clients' => $clients,
            'userclient' => $userclient,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserClient  $userClient
     * @return \Illuminate\Http\Response
     */
    public function update(UserClientRequest $request, UserClient $userclient)
    {
        $request->validated();
        $userclient->fill($request->all());
        $userclient->dtlm = now();
        $userclient->lmby = Auth::user()->id;
        $userclient->save();

        return redirect()
            ->route('userclients.index')
            ->withSuccess("The User Client with id {$userclient->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserClient  $userClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserClient $userclient)
    {
        //
    }
}
