@extends('layouts.app')

@section('title')
Edit Client Gst
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Client Gst</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('clientgsts.update', $clientgst->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('clientgsts.partials.form')
    </form>
</div>

@endsection