@extends('layouts.app')

@section('title')
Create Sub Lob
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Sub Lob</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('sublobs.store')}}" enctype="multipart/form-data">
        @include('sublobs.partials.form',['create' => true ])
    </form>
</div>

@endsection