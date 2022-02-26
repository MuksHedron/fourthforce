@extends('layouts.app')

@section('title')
Create Group Map
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Group Map</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('groupmaps.store')}}" enctype="multipart/form-data">
        @include('groupmaps.partials.form',['create' => true ])
    </form>
</div>

@endsection