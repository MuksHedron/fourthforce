<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRoleRequest;
use App\Models\Role;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskRole;
use Illuminate\Support\Facades\Auth;

class TaskRoleController extends Controller
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

        $taskroles = TaskRole::SearchTaskRoles($q)
            ->paginate(10);

        return view('taskroles.index')->with([
            'taskroles' => $taskroles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks =  Task::all()->sortBy("name");
        $roles =  Role::all()->sortBy("name");

        return view('taskroles.create')->with([
            'tasks' => $tasks,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRoleRequest $request, TaskRole $taskrole)
    {
        $request->validated();

        $taskrole->fill($request->all());
        $taskrole->status = 1;
        $taskrole->dtcr = now();
        $taskrole->crby = Auth::user()->id;
        $taskrole->dtlm = now();
        $taskrole->lmby = Auth::user()->id;
        $taskrole->save();
        return redirect()
            ->route('taskroles.index')
            ->withSuccess("New Task Role with id {$taskrole->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskRole  $taskRole
     * @return \Illuminate\Http\Response
     */
    public function show(TaskRole $taskrole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskRole  $taskRole
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskRole $taskrole)
    {
        $tasks =  Task::all()->sortBy("name");
        $roles =  Role::all()->sortBy("name");

        return view('taskroles.create')->with([
            'tasks' => $tasks,
            'roles' => $roles,
            'taskrole' => $taskrole,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRoleRequest  $request
     * @param  \App\Models\TaskRole  $taskRole
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRoleRequest $request, TaskRole $taskrole)
    {
        $request->validated();
        $taskrole->fill($request->all());
        $taskrole->dtlm = now();
        $taskrole->lmby = Auth::user()->id;
        $taskrole->update();

        return redirect()
            ->route('taskusers.index')
            ->withSuccess("The Task Role with id {$taskrole->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskRole  $taskRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskRole $taskrole)
    {
        //
    }
}
