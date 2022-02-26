@extends('layouts.app')

@section('title')
Edit Area
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Area</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('areas.update', $area->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('areas.partials.form')
    </form>
</div>

@endsection