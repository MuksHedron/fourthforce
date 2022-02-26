<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Lob;
use App\Models\SubLob;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
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

        $tasks = Task::SearchTasks($q)
            ->paginate(10);

        return view('tasks.index')->with([
            'tasks' => $tasks
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lobs = Lob::all()->sortBy("name");
        $sublobs =  SubLob::all()->sortBy("name");

        return view('tasks.create')->with([
            'lobs' => $lobs,
            'sublobs' => $sublobs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request, Task $task)
    {
        $request->validated();

        $task->fill($request->all());
        $task->status = 1;
        $task->dtcr = now();
        $task->crby = Auth::user()->id;
        $task->dtlm = now();
        $task->lmby = Auth::user()->id;
        $task->save();
        return redirect()
            ->route('tasks.index')
            ->withSuccess("New Task with id {$task->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $lobs = Lob::all()->sortBy("name");
        $sublobs =  SubLob::all()->sortBy("name");

        return view('tasks.edit')->with([
            'lobs' => $lobs,
            'sublobs' => $sublobs,
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $request->validated();
        $task->fill($request->all());
        $task->dtlm = now();
        $task->lmby = Auth::user()->id;
        $task->save();

        return redirect()
            ->route('tasks.index')
            ->withSuccess("The Task with id {$task->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
