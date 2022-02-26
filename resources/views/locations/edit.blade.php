@extends('layouts.app')

@section('title')
Edit Location
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Location</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('locations.update', $location->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('locations.partials.form')
    </form>
</div>

@endsection