<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleWorkFlowRequest;
use App\Models\Role;
use App\Models\RoleWorkFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleWorkFlowController extends Controller
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

        $roleworkflows = RoleWorkFlow::SearchRoleWorkFlows($q)
            ->paginate(10);

        return view('roleworkflows.index')->with([
            'roleworkflows' => $roleworkflows
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles =  Role::all()->sortBy("name");

        return view('roleworkflows.create')->with([
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleWorkFlowRequest $request, RoleWorkFlow $roleworkflow)
    {
        $request->validated();

        $roleworkflow->fill($request->all());
        $roleworkflow->status = 1;
        $roleworkflow->dtcr = now();
        $roleworkflow->crby = Auth::user()->id;
        $roleworkflow->dtlm = now();
        $roleworkflow->lmby = Auth::user()->id;
        $roleworkflow->save();
        return redirect()
            ->route('roleworkflows.index')
            ->withSuccess("New Role Work Flow with id {$roleworkflow->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoleWorkFlow  $roleWorkFlow
     * @return \Illuminate\Http\Response
     */
    public function show(RoleWorkFlow $roleworkflow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoleWorkFlow  $roleWorkFlow
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleWorkFlow $roleworkflow)
    {
        $roles =  Role::all()->sortBy("name");

        return view('roleworkflows.edit')->with([
            'roles' => $roles,
            'roleworkflow' => $roleworkflow,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoleWorkFlow  $roleWorkFlow
     * @return \Illuminate\Http\Response
     */
    public function update(RoleWorkFlowRequest $request, RoleWorkFlow $roleworkflow)
    {
        $request->validated();
        $roleworkflow->fill($request->all());
        $roleworkflow->dtlm = now();
        $roleworkflow->lmby = Auth::user()->id;
        $roleworkflow->save();

        return redirect()
            ->route('roleworkflows.index')
            ->withSuccess("The Role Work Flow with id {$roleworkflow->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoleWorkFlow  $roleWorkFlow
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleWorkFlow $roleworkflow)
    {
        //
    }
}
