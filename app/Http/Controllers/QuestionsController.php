<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionsRequest;
use App\Models\File;
use App\Models\Questions;
use App\Models\SubLob;
use App\Models\Task;
use App\Models\TaskRole;
use App\Models\TaskUser;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
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

        $questions = Questions::SearchQuestions($q)
            ->paginate(10);

        return view('questions.index')->with([
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sublobs =  SubLob::all()->sortBy("name");

        return view('questions.create')->with([
            'sublobs' => $sublobs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request, Questions $question)
    {
        $request->validated();

        $question->fill($request->all());
        $question->status = 1;
        $question->dtcr = now();
        $question->crby = Auth::user()->id;
        $question->dtlm = now();
        $question->lmby = Auth::user()->id;
        $question->save();
        return redirect()
            ->route('questions.index')
            ->withSuccess("New Question with id {$question->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function show(Questions $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function edit(Questions $question)
    {
        $sublobs =  SubLob::all()->sortBy("name");

        return view('questions.edit')->with([
            'sublobs' => $sublobs,
            'question' => $question,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $request, Questions $question)
    {
        $request->validated();
        $question->fill($request->all());
        $question->dtlm = now();
        $question->lmby = Auth::user()->id;
        $question->save();

        return redirect()
            ->route('questions.index')
            ->withSuccess("The Question with id {$question->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $question)
    {
        //
    }



    public function questionslob(Request $request)
    {
        $response = "";

        return view('questions.questionslob')->with([
            'fileid' => $request->id,
            'taskid' => $request->taskid,
            'response' => $response,
        ]);
    }

    // public function questionsgroups($id)
    // {
    //     $file = File::find($id);

    //     $questiongroups = Questions::select('questiongroup')->distinct()->where('sublobid', $file->typeid)->get();

    //     return response()->json([$questiongroups]);
    // }

    public function questionsgroups(Request $request)
    {

        $id = $request->get('id');
        $authid = $request->get('auth_id');
        $taskid = $request->get('taskid');

        $file = File::find($id);

        // $questiongroups =  Task::select('task.id', 'task.name')
        //     ->join('taskrole', 'taskrole.taskid', '=', 'task.id')
        //     ->join('taskuser', 'taskuser.taskroleid', '=', 'taskrole.id')
        //     ->where('taskuser.userid', $authid)
        //     ->where('task.sublobid', $file->typeid)
        //     ->get();
        // $role = (new FileController)->roles($authid);

        $auth_user_role = UserRole::where('usersid', $authid)->first();

        if ($auth_user_role->roles->name == "CVO" || $auth_user_role->roles->name == "TVO" || $auth_user_role->roles->name == "Vendor") {
            $questiongroups =  Task::select('task.id', 'task.name')->distinct()
                ->join('taskrole', 'taskrole.taskid', '=', 'task.id')
                ->join('taskuser', 'taskuser.taskid', '=', 'task.id')
                ->where('taskuser.userid', $authid)
                ->where('task.id', $taskid)
                ->where('task.sublobid', $file->typeid)
                ->get();
        } else {
            // $questiongroups =  Task::select('task.id', 'task.name')->distinct()
            //     ->join('taskrole', 'taskrole.taskid', '=', 'task.id')
            //     ->where('task.sublobid', $file->typeid)
            //     // ->where('task.id', $taskid)
            //     ->where('taskrole.roleid', $authid)
            //     ->get();

            $questiongroups =  Task::select('task.id', 'task.name')->distinct()
                ->join('taskrole', 'taskrole.taskid', '=', 'task.id')
                ->where('taskrole.roleid', $auth_user_role->roles->id)
                ->where('task.sublobid', $file->typeid)
                ->get();
        }




        return response()->json([$questiongroups]);
    }




    public function questions($id)
    {
        // $questions = Questions::where('questiongroup', $id)
        //     ->orderBy('questionid')->get();

        $questions = Questions::where('taskid', $id)
            ->orderBy('questionid')->get();

        return response()->json([$questions]);
    }

    public function questionsInital($fileid, $taskid)
    {

        $file = File::find($fileid);
        $questions = Questions::where('taskid', $taskid)
            ->where("sublobid", $file->typeid)
            ->whereNotNull("initial")
            ->orderBy('questionid')->get();

        return $questions;
    }
}
