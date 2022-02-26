<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLobRequest;
use App\Models\SubLob;
use App\Models\User;
use App\Models\UserLob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLobController extends Controller
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

        $userlobs = UserLob::SearchUserLobs($q)
            ->paginate(10);

        return view('userlobs.index')->with([
            'userlobs' => $userlobs
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
        $sublobs =  SubLob::all()->sortBy("name");

        return view('userlobs.create')->with([
            'users' => $users,
            'sublobs' => $sublobs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserLobRequest $request, UserLob $userlob)
    {
        $request->validated();

        $userlob->fill($request->all());
        $userlob->status = 1;
        $userlob->dtcr = now();
        $userlob->crby = Auth::user()->id;
        $userlob->dtlm = now();
        $userlob->lmby = Auth::user()->id;
        $userlob->save();
        return redirect()
            ->route('userlobs.index')
            ->withSuccess("New User Lob with id {$userlob->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserLob  $userLob
     * @return \Illuminate\Http\Response
     */
    public function show(UserLob $userlob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserLob  $userLob
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLob $userlob)
    {
        $users =  User::all()->sortBy("name");
        $sublobs =  SubLob::all()->sortBy("name");

        return view('userlobs.edit')->with([
            'users' => $users,
            'sublobs' => $sublobs,
            'userlob' => $userlob,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserLob  $userLob
     * @return \Illuminate\Http\Response
     */
    public function update(UserLobRequest $request, UserLob $userlob)
    {
        $request->validated();
        $userlob->fill($request->all());
        $userlob->dtlm = now();
        $userlob->lmby = Auth::user()->id;
        $userlob->save();

        return redirect()
            ->route('userlobs.index')
            ->withSuccess("The User Lob with id {$userlob->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserLob  $userLob
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLob $userlob)
    {
        //
    }
}
