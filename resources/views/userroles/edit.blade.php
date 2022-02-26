@extends('layouts.app')

@section('title')
Edit User Role
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit User Role</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('userroles.update', $userrole->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('userroles.partials.form')
    </form>
</div>

@endsection