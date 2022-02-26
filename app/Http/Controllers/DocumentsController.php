<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentsRequest;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
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

        $documents = Documents::SearchDocuments($q)
            ->paginate(10);

        return view('documents.index')->with([
            'documents' => $documents
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentsRequest $request, Documents $document)
    {
        $request->validated();

        $document->fill($request->all());
        $document->status = 1;
        $document->dtcr = now();
        $document->crby = Auth::user()->id;
        $document->dtlm = now();
        $document->lmby = Auth::user()->id;
        $document->save();
        return redirect()
            ->route('documents.index')
            ->withSuccess("New documents with id {$document->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function show(Documents $documents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function edit(Documents $document)
    {
        return view('documents.edit')->with([
            'document' => $document,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentsRequest $request, Documents $document)
    {
        $request->validated();
        $document->fill($request->all());
        $document->dtlm = now();
        $document->lmby = Auth::user()->id;
        $document->save();

        return redirect()
            ->route('documents.index')
            ->withSuccess("The document with id {$document->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documents $documents)
    {
        //
    }
}
