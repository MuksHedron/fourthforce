@extends('layouts.app')

@section('title')
Create User Log
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create User Log</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('userlogs.store')}}" enctype="multipart/form-data">
        @include('userlogs.partials.form',['create' => true ])
    </form>
</div>

@endsection