@extends('layouts.app')

@section('title')
Edit User Log
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit User Log</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('userlogs.update', $userlog->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('userlogs.partials.form')
    </form>
</div>

@endsection