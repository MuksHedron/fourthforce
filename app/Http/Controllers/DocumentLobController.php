<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentLobRequest;
use App\Models\DocumentLob;
use App\Models\Documents;
use App\Models\SubLob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Node\Block\Document;

class DocumentLobController extends Controller
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

        $documentlobs = DocumentLob::SearchDocumentLobs($q)
            ->paginate(10);

        return view('documentlobs.index')->with([
            'documentlobs' => $documentlobs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documents =  Documents::all()->sortBy("name");
        $sublobs =  SubLob::all()->sortBy("name");

        return view('documentlobs.create')->with([
            'documents' => $documents,
            'sublobs' => $sublobs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentLobRequest $request, DocumentLob $documentlob)
    {
        $request->validated();

        $documentlob->fill($request->all());
        $documentlob->status = 1;
        $documentlob->dtcr = now();
        $documentlob->crby = Auth::user()->id;
        $documentlob->dtlm = now();
        $documentlob->lmby = Auth::user()->id;
        $documentlob->save();
        return redirect()
            ->route('documentlobs.index')
            ->withSuccess("New Document Lob with id {$documentlob->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentLob  $documentLob
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentLob $documentLob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentLob  $documentLob
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentLob $documentlob)
    {
        $documents =  Documents::all()->sortBy("name");
        $sublobs =  SubLob::all()->sortBy("name");

        return view('documentlobs.edit')->with([
            'documents' => $documents,
            'sublobs' => $sublobs,
            'documentlob' => $documentlob,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentLob  $documentLob
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentLobRequest $request, DocumentLob $documentlob)
    {
        $request->validated();
        $documentlob->fill($request->all());
        $documentlob->dtlm = now();
        $documentlob->lmby = Auth::user()->id;
        $documentlob->save();

        return redirect()
            ->route('documentlobs.index')
            ->withSuccess("The Document Lob with id {$documentlob->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentLob  $documentLob
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentLob $documentLob)
    {
        //
    }
}
