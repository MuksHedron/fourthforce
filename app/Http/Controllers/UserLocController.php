<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLocRequest;
use App\Models\Location;
use App\Models\User;
use App\Models\UserLoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLocController extends Controller
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

        $userlocs = UserLoc::SearchUserLocs($q)
            ->paginate(10);

        return view('userlocs.index')->with([
            'userlocs' => $userlocs
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
        $users =  User::all()->sortBy("name");

        return view('userlocs.create')->with([
            'locations' => $locations,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserLocRequest $request, UserLoc $userloc)
    {
         
        $request->validated();

       

        $userloc->fill($request->all());
        $userloc->status = 1;
        $userloc->dtcr = now();
        $userloc->crby = Auth::user()->id;
        $userloc->dtlm = now();
        $userloc->lmby = Auth::user()->id;
        $userloc->save();
        return redirect()
            ->route('userlocs.index')
            ->withSuccess("New User Loc with id {$userloc->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserLoc  $userLoc
     * @return \Illuminate\Http\Response
     */
    public function show(UserLoc $userloc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserLoc  $userLoc
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLoc $userloc)
    {
        $locations =  Location::all()->sortBy("name");
        $users =  User::all()->sortBy("name");

        return view('userlocs.edit')->with([
            'locations' => $locations,
            'users' => $users,
            'userloc' => $userloc,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserLoc  $userLoc
     * @return \Illuminate\Http\Response
     */
    public function update(UserLocRequest $request, UserLoc $userloc)
    {
        $request->validated();
        $userloc->fill($request->all());
        $userloc->dtlm = now();
        $userloc->lmby = Auth::user()->id;
        $userloc->save();

        return redirect()
            ->route('userlocs.index')
            ->withSuccess("The User Loc with id {$userloc->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserLoc  $userLoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLoc $userloc)
    {
        //
    }
}
