@extends('layouts.app')

@section('title')
Create User Group
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create User Group</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('usergroups.store')}}" enctype="multipart/form-data">
        @include('usergroups.partials.form',['create' => true ])
    </form>
</div>

@endsection