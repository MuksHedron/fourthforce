@extends('layouts.app')

@section('title')
Edit Hub
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Hub</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('hubs.update', $hub->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('hubs.partials.form')
    </form>
</div>

@endsection