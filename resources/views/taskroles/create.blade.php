@extends('layouts.app')

@section('title')
Create Task Role
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Task Role</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('taskroles.store')}}" enctype="multipart/form-data">
        @include('taskroles.partials.form',['create' => true ])
    </form>
</div>

@endsection