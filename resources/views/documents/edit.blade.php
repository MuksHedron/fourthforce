@extends('layouts.app')

@section('title')
Edit Document
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Document</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('documents.update', $document->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('documents.partials.form')
    </form>
</div>

@endsection