@extends('layouts.app')

@section('title')
Create Client State
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Client State</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('clientstates.store')}}" enctype="multipart/form-data">
        @include('clientstates.partials.form',['create' => true ])
    </form>
</div>

@endsection