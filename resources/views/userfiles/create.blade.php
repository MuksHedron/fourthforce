@extends('layouts.app')

@section('title')
Create User File
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create User File</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('userfiles.store')}}" enctype="multipart/form-data">
        @include('userfiles.partials.form',['create' => true ])
    </form>
</div>

@endsection