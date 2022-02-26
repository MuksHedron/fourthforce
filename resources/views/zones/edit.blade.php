@extends('layouts.app')

@section('title')
Edit Zone
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Zone</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('zones.update', $zone->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('zones.partials.form')
    </form>
</div>

@endsection