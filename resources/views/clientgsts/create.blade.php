@extends('layouts.app')

@section('title')
Create Client Gst
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Client Gst</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('clientgsts.store')}}" enctype="multipart/form-data">
        @include('clientgsts.partials.form',['create' => true ])
    </form>
</div>

@endsection