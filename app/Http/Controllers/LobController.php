<?php

namespace App\Http\Controllers;

use App\Http\Requests\LobRequest;
use App\Models\Lob; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = null;
        
        if($request->has('q')) $q = $request->query('q');

        $lobs=Lob::SearchLobs($q)
        ->paginate(10);

        return view('lobs.index')->with([
            'lobs' => $lobs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('lobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLobRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LobRequest $request, Lob $lob)
    {
        $request->validated();

        $lob->fill($request->all());
        $lob->status = 1;
        $lob->dtcr = now();
        $lob->crby = Auth::user()->id;
        $lob->dtlm = now();
        $lob->lmby = Auth::user()->id;
        $lob->save();
        return redirect()
            ->route('lobs.index')
            ->withSuccess("New Lob with id {$lob->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lob  $lob
     * @return \Illuminate\Http\Response
     */
    public function show(Lob $lob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lob  $lob
     * @return \Illuminate\Http\Response
     */
    public function edit(Lob $lob)
    { 
        return view('lobs.edit')->with([
            'lob' => $lob,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLobRequest  $request
     * @param  \App\Models\Lob  $lob
     * @return \Illuminate\Http\Response
     */
    public function update(LobRequest $request, Lob $lob)
    {
        $request->validated();
        $lob->fill($request->all());
        $lob->dtlm = now();
        $lob->lmby = Auth::user()->id;
        $lob->save();

        return redirect()
            ->route('lobs.index')
            ->withSuccess("The Lob with id {$lob->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lob  $lob
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lob $lob)
    {
        //
    }
}
