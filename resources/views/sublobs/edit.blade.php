@extends('layouts.app')

@section('title')
Edit Sub Lob
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Sub Lob</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('sublobs.update', $sublob->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('sublobs.partials.form')
    </form>
</div>

@endsection