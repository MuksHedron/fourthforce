@extends('layouts.app')

@section('title')
Edit Document Lob
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Document Lob</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('documentlobs.update', $documentlob->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('documentlobs.partials.form')
    </form>
</div>

@endsection