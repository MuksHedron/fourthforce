@extends('layouts.app')

@section('title')
Edit Client
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Client</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('clients.update', $client->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('clients.partials.form')
    </form>
</div>

@endsection