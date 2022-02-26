@extends('layouts.app')

@section('title')
Edit User Group
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit User Group</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('usergroups.update', $usergroup->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('usergroups.partials.form')
    </form>
</div>

@endsection