@extends('layouts.app')

@section('title')
Edit Client State User
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Client State User</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('clientstateusers.update', $clientstateuser->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('clientstateusers.partials.form')
    </form>
</div>

@endsection