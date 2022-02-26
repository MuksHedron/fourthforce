@extends('layouts.app')

@section('title')
Create Client State User
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Client State User</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('clientstateusers.store')}}" enctype="multipart/form-data">
        @include('clientstateusers.partials.form',['create' => true ])
    </form>
</div>

@endsection