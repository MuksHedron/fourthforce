<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStateUserRequest;
use App\Models\ClientState;
use App\Models\ClientStateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientStateUserController extends Controller
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

        $clientstateusers = ClientStateUser::SearchClientStateUsers($q)
            ->paginate(10);

        return view('clientstateusers.index')->with([
            'clientstateusers' => $clientstateusers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientstates =  ClientState::all()->sortBy("states.name");
        $users =  User::all()->sortBy("name");

        return view('clientstateusers.create')->with([
            'clientstates' => $clientstates,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStateUserRequest $request, ClientStateUser $clientstateuser)
    {
        $request->validated();

        $clientstateuser->fill($request->all());
        $clientstateuser->status = 1;
        $clientstateuser->dtcr = now();
        $clientstateuser->crby = Auth::user()->id;
        $clientstateuser->dtlm = now();
        $clientstateuser->lmby = Auth::user()->id;
        $clientstateuser->save();

        return redirect()
            ->route('clientstateusers.index')
            ->withSuccess("New Client State User with id {$clientstateuser->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientStateUser  $clientStateUser
     * @return \Illuminate\Http\Response
     */
    public function show(ClientStateUser $clientStateUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientStateUser  $clientStateUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientStateUser $clientstateuser)
    {
        $clientstates =  ClientState::all()->sortBy("name");
        $users =  User::all()->sortBy("name");

        return view('clientstateusers.edit')->with([
            'clientstates' => $clientstates,
            'users' => $users,
            'clientstateuser' => $clientstateuser,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientStateUser  $clientStateUser
     * @return \Illuminate\Http\Response
     */
    public function update(ClientStateUserRequest $request, ClientStateUser $clientstateuser)
    {
        $request->validated();
        $clientstateuser->fill($request->all());
        $clientstateuser->dtlm = now();
        $clientstateuser->lmby = Auth::user()->id;
        $clientstateuser->save();

        return redirect()
            ->route('clientstateusers.index')
            ->withSuccess("The Client State User with id {$clientstateuser->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientStateUser  $clientStateUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientStateUser $clientStateUser)
    {
        //
    }
}
