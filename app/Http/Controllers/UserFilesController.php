<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFileRequest;
use App\Models\File;
use App\Models\User;
use App\Models\UserFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFilesController extends Controller
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

        $userfiles = UserFiles::SearchUserFiles($q)->paginate(10);

        return view('userfiles.index')->with([
            'userfiles' => $userfiles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $files =  File::all()->sortBy("name");
        $users =  User::all()->sortBy("name");

        return view('userfiles.create')->with([
            'files' => $files,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFileRequest $request, UserFiles $userfile)
    {
        $request->validated();

        $userfile->fill($request->all());
        $userfile->status = 1;
        $userfile->dtcr = now();
        $userfile->crby = Auth::user()->id;
        $userfile->dtlm = now();
        $userfile->lmby = Auth::user()->id;
        $userfile->save();
        return redirect()
            ->route('userfiles.index')
            ->withSuccess("New User File with id {$userfile->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserFiles  $userfiles
     * @return \Illuminate\Http\Response
     */
    public function show(UserFiles $userfiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userfiles  $userfiles
     * @return \Illuminate\Http\Response
     */
    public function edit(UserFiles $userfile)
    {
        $files =  File::all()->sortBy("name");
        $users =  User::all()->sortBy("name");

        return view('userfiles.edit')->with([
            'files' => $files,
            'users' => $users,
            'userfile' => $userfile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserFiles  $userfiles
     * @return \Illuminate\Http\Response
     */
    public function update(UserFileRequest $request, UserFiles $userfile)
    {
        $request->validated();
        $userfile->fill($request->all());
        $userfile->dtlm = now();
        $userfile->lmby = Auth::user()->id;
        $userfile->save();

        return redirect()
            ->route('userfiles.index')
            ->withSuccess("The User File with id {$userfile->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserFiles  $userfiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserFiles $userfiles)
    {
        //
    }
}
