@extends('layouts.app')

@section('title')
Create User Role
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create User Role</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('userroles.store')}}" enctype="multipart/form-data">
        @include('userroles.partials.form',['create' => true ])
    </form>
</div>

@endsection