@extends('layouts.app')

@section('title')
Edit User Location
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit User Location</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('userlocs.update', $userloc->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('userlocs.partials.form')
    </form>
</div>

@endsection