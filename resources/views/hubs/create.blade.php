@extends('layouts.app')

@section('title')
Create Hub
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Hub</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('hubs.store')}}" enctype="multipart/form-data">
        @include('hubs.partials.form',['create' => true ])
    </form>
</div>

@endsection