<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubLobRequest;
use App\Models\Lob;
use App\Models\SubLob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubLobController extends Controller
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

        $sublobs = SubLob::SearchSubLobs($q)
            ->paginate(10);

        return view('sublobs.index')->with([
            'sublobs' => $sublobs
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lobs =  Lob::all()->sortBy("name");

        return view('sublobs.create')->with([
            'lobs' => $lobs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubLobRequest $request, SubLob $sublob)
    {
        $request->validated();

        $sublob->fill($request->all());
        $sublob->status = 1;
        $sublob->dtcr = now();
        $sublob->crby = Auth::user()->id;
        $sublob->dtlm = now();
        $sublob->lmby = Auth::user()->id;
        $sublob->save();
        return redirect()
            ->route('sublobs.index')
            ->withSuccess("New Sub Lob with id {$sublob->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubLob  $subLob
     * @return \Illuminate\Http\Response
     */
    public function show(SubLob $sublob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubLob  $subLob
     * @return \Illuminate\Http\Response
     */
    public function edit(SubLob $sublob)
    {
        $lobs =  Lob::all()->sortBy("name");

        return view('sublobs.edit')->with([
            'lobs' => $lobs,
            'sublob' => $sublob,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubLob  $subLob
     * @return \Illuminate\Http\Response
     */
    public function update(SubLobRequest $request, SubLob $sublob)
    {
        $request->validated();
        $sublob->fill($request->all());
        $sublob->dtlm = now();
        $sublob->lmby = Auth::user()->id;
        $sublob->save();

        return redirect()
            ->route('sublobs.index')
            ->withSuccess("The Sub Lob with id {$sublob->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubLob  $subLob
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubLob $sublob)
    {
        //
    }
}
