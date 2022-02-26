@extends('layouts.app')

@section('title')
Create Usr Locations
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create User Location</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('userlocs.store')}}" enctype="multipart/form-data">
        @include('userlocs.partials.form',['create' => true ])
    </form>
</div>

@endsection