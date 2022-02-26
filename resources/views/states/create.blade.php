@extends('layouts.app')

@section('title')
Create State
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create State</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('states.store')}}" enctype="multipart/form-data">
        @include('states.partials.form',['create' => true ])
    </form>
</div>

@endsection