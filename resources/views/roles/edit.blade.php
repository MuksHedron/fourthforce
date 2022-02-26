@extends('layouts.app')

@section('title')
Edit Role
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Role</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('roles.update', $role->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('roles.partials.form')
    </form>
</div>

@endsection