@extends('layouts.app')

@section('title')
Create Area
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Area</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('areas.store')}}" enctype="multipart/form-data">
        @include('areas.partials.form',['create' => true ])
    </form>
</div>

@endsection