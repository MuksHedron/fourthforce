@extends('layouts.app')

@section('title')
Create Role
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Role</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('roles.store')}}" enctype="multipart/form-data">
        @include('roles.partials.form',['create' => true ])
    </form>
</div>

@endsection