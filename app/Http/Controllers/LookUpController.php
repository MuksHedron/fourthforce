<?php

namespace App\Http\Controllers;

use App\Http\Requests\LookUpRequest;
use App\Models\File;
use App\Models\LookUp;
use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LookUpController extends Controller
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

        $lookups = LookUp::Searchlookups($q)
            ->paginate(10);

        return view('lookups.index')->with([
            'lookups' => $lookups
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lookups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLookUpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LookUpRequest $request, LookUp $lookup)
    {
        $request->validated();

        $lookup->fill($request->all());
        $lookup->status = 1;
        $lookup->dtcr = now();
        $lookup->crby = Auth::user()->id;
        $lookup->dtlm = now();
        $lookup->lmby = Auth::user()->id;
        $lookup->save();
        return redirect()
            ->route('lookups.index')
            ->withSuccess("New Lookup with id {$lookup->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LookUp  $lookUp
     * @return \Illuminate\Http\Response
     */
    public function show(LookUp $lookup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LookUp  $lookUp
     * @return \Illuminate\Http\Response
     */
    public function edit(LookUp $lookup)
    {
        return view('lookups.edit')->with([
            'lookup' => $lookup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLookUpRequest  $request
     * @param  \App\Models\LookUp  $lookUp
     * @return \Illuminate\Http\Response
     */
    public function update(LookUpRequest $request, LookUp $lookup)
    {
        $request->validated();
        $lookup->fill($request->all());
        $lookup->dtlm = now();
        $lookup->lmby = Auth::user()->id;
        $lookup->save();

        return redirect()
            ->route('lookups.index')
            ->withSuccess("The Lookup with id {$lookup->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LookUp  $lookUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(LookUp $lookup)
    {
        //
    }


    public function lookups($id)
    {
        $file = File::find($id);
        $lookuptype = Questions::select(['lookuptype'])
            ->where("sublobid", $file->typeid)
            ->whereNotNull('lookuptype')
            ->orderBy('id')->get();
        $lookups = LookUp::whereIn("type", $lookuptype)
            ->orderBy('id')->get();



        return response()->json([$lookups]);
    }
}
