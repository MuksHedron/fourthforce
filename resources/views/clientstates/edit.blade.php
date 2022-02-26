@extends('layouts.app')

@section('title')
Edit Client State
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Client State</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('clientstates.update', $clientstate->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('clientstates.partials.form')
    </form>
</div>

@endsection