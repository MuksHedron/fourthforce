@extends('layouts.app')

@section('title')
Edit User Client
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit User Client</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('userclients.update', $userclient->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('userclients.partials.form')
    </form>
</div>

@endsection