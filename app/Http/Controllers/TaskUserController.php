<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskUserRequest;
use App\Models\Task;
use App\Models\TaskRole;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskUserController extends Controller
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

        $taskusers = TaskUser::SearchTaskUsers($q)
            ->paginate(10);

        return view('taskusers.index')->with([
            'taskusers' => $taskusers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taskroles =  TaskRole::all()->sortBy("tasks.name");
        $users =  User::all()->sortBy("name");

        return view('taskusers.create')->with([
            'taskroles' => $taskroles,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskUserRequest $request, TaskUser $taskuser)
    {
        $request->validated();

        $taskuser->fill($request->all());
        $taskuser->status = 1;
        $taskuser->dtcr = now();
        $taskuser->crby = Auth::user()->id;
        $taskuser->dtlm = now();
        $taskuser->lmby = Auth::user()->id;
        $taskuser->save();
        return redirect()
            ->route('taskusers.index')
            ->withSuccess("New Task User with id {$taskuser->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskUser  $taskUser
     * @return \Illuminate\Http\Response
     */
    public function show(TaskUser $taskuser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskUser  $taskUser
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskUser $taskuser)
    {


        $taskroles =  TaskRole::all()->sortBy("tasks.name");
        $users =  User::all()->sortBy("name");

        return view('taskusers.edit')->with([
            'taskroles' => $taskroles,
            'users' => $users,
            'taskuser' => $taskuser,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskUser  $taskUser
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUserRequest $request, TaskUser $taskuser)
    {
        $request->validated();
        $taskuser->fill($request->all());
        $taskuser->dtlm = now();
        $taskuser->lmby = Auth::user()->id;
        $taskuser->save();

        return redirect()
            ->route('taskusers.index')
            ->withSuccess("The Task User with id {$taskuser->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskUser  $taskUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskUser $taskuser)
    {
        //
    }
}
