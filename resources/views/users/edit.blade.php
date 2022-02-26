@extends('layouts.app')

@section('title')
    Edit User
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit User</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('users.partials.form')
    </form>
</div>

@endsection