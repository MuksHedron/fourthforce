@extends('layouts.app')

@section('title')
Edit State
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit State</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('states.update', $state->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('states.partials.form')
    </form>
</div>

@endsection