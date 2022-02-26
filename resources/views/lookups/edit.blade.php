@extends('layouts.app')

@section('title')
Edit Lookup
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Lookup</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('lookups.update', $lookup->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('lookups.partials.form')
    </form>
</div>

@endsection