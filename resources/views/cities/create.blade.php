@extends('layouts.app')

@section('title')
Create City
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create City</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('cities.store')}}" enctype="multipart/form-data">
        @include('cities.partials.form',['create' => true ])
    </form>
</div>

@endsection