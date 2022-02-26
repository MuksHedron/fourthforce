<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupMapRequest;
use App\Models\GroupMap;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Group;

class GroupMapController extends Controller
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

        $groupmaps = GroupMap::SearchAreas($q)
            ->paginate(10);

        return view('groupmaps.index')->with([
            'groupmaps' => $groupmaps
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usergroups =  UserGroup::all()->sortBy("name");
        $users =  User::all()->sortBy("name");

        return view('groupmaps.create')->with([
            'usergroups' => $usergroups,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupMapRequest $request, GroupMap $groupmap)
    {
        $request->validated();

        $groupmap->fill($request->all());
        $groupmap->status = 1;
        $groupmap->dtcr = now();
        $groupmap->crby = Auth::user()->id;
        $groupmap->dtlm = now();
        $groupmap->lmby = Auth::user()->id;
        $groupmap->save();
        return redirect()
            ->route('groupmaps.index')
            ->withSuccess("New Group Maps with id {$groupmap->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupMap  $groupMap
     * @return \Illuminate\Http\Response
     */
    public function show(GroupMap $groupmap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupMap  $groupMap
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupMap $groupmap)
    {
        $usergroups =  UserGroup::all()->sortBy("name");
        $users =  User::all()->sortBy("name");

        return view('groupmaps.edit')->with([
            'usergroups' => $usergroups,
            'users' => $users,
            'groupmap' => $groupmap,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupMap  $groupMap
     * @return \Illuminate\Http\Response
     */
    public function update(GroupMapRequest $request, GroupMap $groupmap)
    {
        $request->validated();
        $groupmap->fill($request->all());
        $groupmap->dtlm = now();
        $groupmap->lmby = Auth::user()->id;
        $groupmap->save();

        return redirect()
            ->route('groupmaps.index')
            ->withSuccess("The Group Map with id {$groupmap->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupMap  $groupMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupMap $groupmap)
    {
        //
    }
}
