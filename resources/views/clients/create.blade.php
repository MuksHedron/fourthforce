@extends('layouts.app')

@section('title')
Create Client
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Client</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('clients.store')}}" enctype="multipart/form-data">
        @include('clients.partials.form',['create' => true ])
    </form>
</div>

@endsection