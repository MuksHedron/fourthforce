<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserGroupRequest;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserGroupController extends Controller
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

        $usergroups = UserGroup::SearchUserGroups($q)
            ->paginate(10);

        return view('usergroups.index')->with([
            'usergroups' => $usergroups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usergroups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserGroupRequest $request, UserGroup $usergroup)
    {
        $request->validated();

        $usergroup->fill($request->all());
        $usergroup->status = 1;
        $usergroup->dtcr = now();
        $usergroup->crby = Auth::user()->id;
        $usergroup->dtlm = now();
        $usergroup->lmby = Auth::user()->id;
        $usergroup->save();
        return redirect()
            ->route('usergroups.index')
            ->withSuccess("New User Group with id {$usergroup->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function show(UserGroup $usergroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(UserGroup $usergroup)
    {
        return view('usergroups.edit')->with([ 
            'usergroup' => $usergroup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UserGroupRequest $request, UserGroup $usergroup)
    {
        $request->validated();
        $usergroup->fill($request->all());
        $usergroup->dtlm = now();
        $usergroup->lmby = Auth::user()->id;
        $usergroup->save();

        return redirect()
            ->route('usergroups.index')
            ->withSuccess("The User Group with id {$usergroup->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserGroup $usergroup)
    {
        //
    }
}
