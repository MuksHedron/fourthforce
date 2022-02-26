@extends('layouts.app')

@section('title')
Edit User File
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit User File</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('userfiles.update', $userfile->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('userfiles.partials.form')
    </form>
</div>

@endsection