@extends('layouts.app')

@section('title')
Edit User Lob
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit User Lob</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('userlobs.update', $userlob->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('userlobs.partials.form')
    </form>
</div>

@endsection