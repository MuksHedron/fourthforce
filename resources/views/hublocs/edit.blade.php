@extends('layouts.app')

@section('title')
Edit Hub Location
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Hub Location</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('hublocs.update', $hubloc->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('hublocs.partials.form')
    </form>
</div>

@endsection