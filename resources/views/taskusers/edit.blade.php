@extends('layouts.app')

@section('title')
Edit Task User
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Task User</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('taskusers.update', $taskuser->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('taskusers.partials.form')
    </form>
</div>

@endsection