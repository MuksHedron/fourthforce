<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkFlowRequest;
use App\Models\WorkFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkFlowController extends Controller
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

        $workflows = WorkFlow::SearchWorkFlows($q)
            ->paginate(10);

        return view('workflows.index')->with([
            'workflows' => $workflows
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workflows.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkFlowRequest $request, WorkFlow $workflow)
    {
        $request->validated();

        $workflow->fill($request->all());
        $workflow->status = 1;
        $workflow->dtcr = now();
        $workflow->crby = Auth::user()->id;
        $workflow->dtlm = now();
        $workflow->lmby = Auth::user()->id;
        $workflow->save();
        return redirect()
            ->route('workflows.index')
            ->withSuccess("New Work Flow with id {$workflow->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkFlow  $workFlow
     * @return \Illuminate\Http\Response
     */
    public function show(WorkFlow $workflow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkFlow  $workFlow
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkFlow $workflow)
    {
        return view('workflows.edit')->with([
            'workflow' => $workflow,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkFlow  $workFlow
     * @return \Illuminate\Http\Response
     */
    public function update(WorkFlowRequest $request, WorkFlow $workflow)
    {
        $request->validated();
        $workflow->fill($request->all());
        $workflow->dtlm = now();
        $workflow->lmby = Auth::user()->id;
        $workflow->save();

        return redirect()
            ->route('workflows.index')
            ->withSuccess("The Work Flow with id {$workflow->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkFlow  $workFlow
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkFlow $workflow)
    {
        //
    }
}
