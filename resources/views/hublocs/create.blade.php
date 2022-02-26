@extends('layouts.app')

@section('title')
Create Hub Location
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Hub Location</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('hublocs.store')}}" enctype="multipart/form-data">
        @include('hublocs.partials.form',['create' => true ])
    </form>
</div>

@endsection