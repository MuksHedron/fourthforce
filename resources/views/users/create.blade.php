@extends('layouts.app')

@section('title')
    Create User
@endsection
 


@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create User</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data"> 
       @include('users.partials.form',['create' => true ])
</form>
</div>

@endsection