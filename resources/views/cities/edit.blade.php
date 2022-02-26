@extends('layouts.app')

@section('title')
Edit City
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit City</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('cities.update', $city->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('cities.partials.form')
    </form>
</div>

@endsection