<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
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

        $userroles = UserRole::SearchUserRoles($q)->paginate(10);

        return view('userroles.index')->with([
            'userroles' => $userroles,
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
        $roles =  Role::all()->sortBy("name");

        return view('userroles.create')->with([
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRoleRequest $request, UserRole $userrole)
    {
        
        $request->validated();

        $userrole->fill($request->all());
        $userrole->status = 1;
        $userrole->dtcr = now();
        $userrole->crby = Auth::user()->id;
        $userrole->dtlm = now();
        $userrole->lmby = Auth::user()->id;
        $userrole->save();
        return redirect()
            ->route('userroles.index')
            ->withSuccess("New User Role with id {$userrole->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function show(UserRole $userrole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRole $userrole)
    {
        $users =  User::all()->sortBy("name");
        $roles =  Role::all()->sortBy("name");

        return view('userroles.edit')->with([
            'users' => $users,
            'roles' => $roles,
            'userrole' => $userrole
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function update(UserRoleRequest $request, UserRole $userrole)
    {
        $request->validated();
        $userrole->fill($request->all());
        $userrole->dtlm = now();
        $userrole->lmby = Auth::user()->id;
        $userrole->save();

        return redirect()
            ->route('userroles.index')
            ->withSuccess("The User Role with id {$userrole->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRole $userrole)
    {
        //
    }
}
